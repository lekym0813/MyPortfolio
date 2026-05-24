<?php
header('Content-Type: application/json');
require_once('db_config.php');

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

$user = null;
$stmt = $conn->prepare("SELECT id, name, accountnum, address FROM public.users WHERE id = ?");
$stmt->execute([$user_id]);
$row = $stmt->fetch();
if ($row) {
    $user = $row;
}
$stmt = null;

if (!$user) {
    echo json_encode(["success" => false, "message" => "User not found"]);
    exit;
}

$currentBill = null;
$stmt = $conn->prepare("SELECT cust_id, billing_month, amount, due_date, status, treading FROM public.customer WHERE cust_account = ? ORDER BY due_date DESC LIMIT 1");
$stmt->execute([$user['accountnum']]);
$row = $stmt->fetch();
if ($row) {
    $currentBill = [
        "id" => (string)$row['cust_id'],
        "month" => $row['billing_month'],
        "amount" => (double)$row['amount'],
        "dueDate" => $row['due_date'],
        "status" => trim($row['status']),
        "units" => (int)$row['treading'],
        "readingDate" => $row['due_date']
    ];
}
$stmt = null;

$outstanding = 0;
$stmt = $conn->prepare("SELECT COALESCE(SUM(amount), 0) as total FROM public.customer WHERE cust_account = ? AND LOWER(TRIM(status)) != 'paid'");
$stmt->execute([$user['accountnum']]);
$row = $stmt->fetch();
if ($row) {
    $outstanding = (double)$row['total'];
}
$stmt = null;

$monthlyUsage = [];
$stmt = $conn->prepare("SELECT billing_month, treading as units, amount FROM public.customer WHERE cust_account = ? ORDER BY due_date DESC LIMIT 5");
$stmt->execute([$user['accountnum']]);
while ($row = $stmt->fetch()) {
    $monthlyUsage[] = [
        "month" => $row['billing_month'],
        "units" => (int)$row['units'],
        "amount" => (double)$row['amount']
    ];
}
$stmt = null;
$monthlyUsage = array_reverse($monthlyUsage);

echo json_encode([
    "success" => true,
    "userName" => $user['name'],
    "accountNumber" => $user['accountnum'],
    "currentBill" => $currentBill,
    "outstandingBalance" => $outstanding,
    "currentUsage" => $currentBill ? (float)$currentBill['units'] : 0.0,
    "monthlyUsage" => $monthlyUsage,
    "notifications" => 0
]);

$conn = null;
?>
