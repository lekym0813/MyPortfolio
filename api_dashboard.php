<?php
header('Content-Type: application/json');
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
    exit;
}

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode(["success" => false, "message" => "User ID is required"]);
    exit;
}

$stmt = $conn->prepare("SELECT id, name, accountnum, address FROM users WHERE id = ?");
if (!$stmt) { echo json_encode(["success" => false, "message" => "DB error"]); exit; }
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo json_encode(["success" => false, "message" => "User not found"]);
    exit;
}

$accountnum = $user['accountnum'];
$currentBill = null;

if (!empty($accountnum)) {
    $stmt = $conn->prepare("SELECT cust_id, cust_name, cust_account, amount, billing_month, due_date, status, PrReading, CReading, TReading FROM customer WHERE cust_account = ? ORDER BY due_date DESC LIMIT 1");
    if ($stmt) {
        $stmt->execute([$accountnum]);
        if ($row = $stmt->fetch()) {
            $consumption = (double)($row['TReading'] ?? 0);
            $custId = $row['cust_id'];
            $dbStatus = $row['status'] ?? 'Unpaid';
            $billStatus = strtoupper($dbStatus) === 'PAID' ? 'PAID' : 'UNPAID';

            $currentBill = [
                "id" => (string)$custId,
                "month" => $row['billing_month'] ?: date('F Y'),
                "amount" => (double)$row['amount'],
                "dueDate" => $row['due_date'],
                "status" => $billStatus,
                "units" => (int)$consumption,
                "readingDate" => $row['due_date'],
                "previousReading" => (double)($row['PrReading'] ?? 0),
                "currentReading" => (double)($row['CReading'] ?? 0)
            ];
        }
    }
}

$outstanding = 0;
if (!empty($accountnum)) {
    $stmt = $conn->prepare("SELECT COALESCE(SUM(amount), 0) as total FROM customer WHERE cust_account = ? AND (status IS NULL OR status != 'Paid')");
    if ($stmt) {
        $stmt->execute([$accountnum]);
        if ($row = $stmt->fetch()) {
            $outstanding = (double)$row['total'];
        }
    }
}

echo json_encode([
    "success" => true,
    "userName" => $user['name'],
    "accountNumber" => $user['accountnum'],
    "currentBill" => $currentBill,
    "outstandingBalance" => $outstanding,
    "currentUsage" => $currentBill ? $consumption : 0.0,
    "monthlyUsage" => [
        ["month" => "January", "units" => 28, "amount" => 1920.00],
        ["month" => "February", "units" => 32, "amount" => 1710.00],
        ["month" => "March", "units" => 29, "amount" => 1860.00],
        ["month" => "April", "units" => 35, "amount" => 2100.00],
        ["month" => "May", "units" => 32, "amount" => 2450.00]
    ],
    "notifications" => 0
]);
?>
