<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
    exit();
}

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([]);
    exit();
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
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT cust_id, cust_account, billing_month, amount, due_date, status, prreading, creading, treading FROM public.customer WHERE cust_account = ? ORDER BY due_date DESC");
$stmt->execute([$user['accountnum']]);

$bills = [];
while ($row = $stmt->fetch()) {
    $bills[] = [
        "id" => (string)$row['cust_id'],
        "accountnum" => $row['cust_account'],
        "month" => $row['billing_month'],
        "duedate" => $row['due_date'],
        "total" => (string)$row['amount'],
        "status" => trim($row['status']),
        "previous" => $row['prreading'] !== null ? (string)$row['prreading'] : null,
        "present" => $row['creading'] !== null ? (string)$row['creading'] : null,
        "consumed" => $row['treading'] !== null ? (string)$row['treading'] : null
    ];
}

echo json_encode($bills);

$stmt = null;
$conn = null;
?>
