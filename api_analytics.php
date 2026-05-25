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
$stmt = $conn->prepare("SELECT accountnum FROM public.users WHERE id = ?");
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

$bills = [];
$stmt = $conn->prepare("SELECT billing_month, treading, amount, due_date, status FROM public.customer WHERE cust_account = ? ORDER BY due_date ASC");
$stmt->execute([$user['accountnum']]);
while ($row = $stmt->fetch()) {
    $bills[] = [
        "month" => $row['billing_month'],
        "units" => (int)$row['treading'],
        "amount" => (double)$row['amount'],
        "dueDate" => $row['due_date'],
        "status" => trim($row['status'])
    ];
}
$stmt = null;

$totalConsumption = 0;
$totalAmount = 0.0;
$peakUsage = 0;
foreach ($bills as $b) {
    $totalConsumption += $b['units'];
    $totalAmount += $b['amount'];
    if ($b['units'] > $peakUsage) $peakUsage = $b['units'];
}

$months = count($bills);
$averageMonthly = $months > 0 ? round($totalAmount / $months, 2) : 0.0;

echo json_encode([
    "success" => true,
    "bills" => $bills,
    "totalConsumption" => $totalConsumption,
    "averageMonthly" => $averageMonthly,
    "peakUsage" => $peakUsage,
    "months" => $months
]);

$conn = null;
?>
