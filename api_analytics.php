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

$stmt = $conn->prepare("SELECT accountnum FROM users WHERE id = ?");
if (!$stmt) { echo json_encode(["success" => false, "message" => "DB error"]); exit; }
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user || empty($user['accountnum'])) {
    echo json_encode(["success" => false, "bills" => []]);
    exit;
}

$accountnum = $user['accountnum'];
$stmt = $conn->prepare("SELECT billing_month, TReading, amount, due_date, status FROM customer WHERE cust_account = ? AND TReading > 0 ORDER BY due_date ASC");
if (!$stmt) { echo json_encode(["success" => false, "message" => "DB error"]); exit; }
$stmt->execute([$accountnum]);

$bills = [];
$totalUnits = 0;
$totalAmount = 0;
$peakUnits = 0;
$monthCount = 0;

while ($row = $stmt->fetch()) {
    $units = (int)($row['TReading'] ?? 0);
    $amount = (double)($row['amount'] ?? 0);
    $totalUnits += $units;
    $totalAmount += $amount;
    $monthCount++;
    if ($units > $peakUnits) $peakUnits = $units;

    $bills[] = [
        "month" => $row['billing_month'] ?: '',
        "units" => $units,
        "amount" => $amount,
        "dueDate" => $row['due_date'] ?: '',
        "status" => $row['status'] ?? 'Unpaid'
    ];
}

$avgMonthly = $monthCount > 0 ? round($totalUnits / $monthCount, 1) : 0;

echo json_encode([
    "success" => true,
    "bills" => $bills,
    "totalConsumption" => $totalUnits,
    "averageMonthly" => $avgMonthly,
    "peakUsage" => $peakUnits,
    "months" => $monthCount
]);
?>