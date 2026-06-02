<?php
header('Content-Type: application/json');
require_once('db.php');

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([]);
    exit;
}

$accountnum = '';
$stmt = $conn->prepare("SELECT accountnum FROM users WHERE id = ?");
$stmt->execute([$user_id]);
if ($row = $stmt->fetch()) {
    $accountnum = $row['accountnum'];
}

if (empty($accountnum)) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT cust_id, cust_account, amount, billing_month, due_date, status, PrReading, CReading, TReading FROM customer WHERE cust_account = ? ORDER BY due_date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute([$accountnum]);

$bills = [];
while ($row = $stmt->fetch()) {
    $bills[] = [
        'id' => $row['cust_id'],
        'accountnum' => $row['cust_account'],
        'duedate' => $row['due_date'],
        'total' => (string)$row['amount'],
        'status' => $row['status'] ?? 'Unpaid',
        'previous' => (string)($row['PrReading'] ?? 0),
        'present' => (string)($row['CReading'] ?? 0),
        'consumed' => (string)($row['TReading'] ?? 0)
    ];
}

echo json_encode($bills);
?>
