<?php
header('Content-Type: application/json');
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
    exit;
}

$bill_id = $_GET['bill_id'] ?? '';

if (empty($bill_id)) {
    echo json_encode(["success" => false, "message" => "Bill ID is required"]);
    exit;
}

$sql = "SELECT cust_id, cust_name, cust_account, cust_address, amount, due_date, billing_month, PrReading, CReading, TReading FROM customer WHERE cust_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$bill_id]);

if ($row = $stmt->fetch()) {
    echo json_encode([
        "success" => true,
        "id" => (string)$row['cust_id'],
        "name" => $row['cust_name'] ?? '',
        "accountnum" => $row['cust_account'] ?? '',
        "address" => $row['cust_address'] ?? '',
        "total" => (string)$row['amount'],
        "duedate" => $row['due_date'] ?? '',
        "month" => $row['billing_month'] ?? '',
        "previous" => (string)($row['PrReading'] ?? 0),
        "present" => (string)($row['CReading'] ?? 0),
        "consumed" => (string)($row['TReading'] ?? 0)
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Bill not found"]);
}
?>
