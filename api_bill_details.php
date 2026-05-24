<?php
header('Content-Type: application/json');
require_once('db_config.php');

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

$stmt = $conn->prepare("SELECT c.cust_id, c.billing_month, c.amount, c.due_date, c.status, c.prreading, c.creading, c.treading, u.name, u.accountnum, u.address
                        FROM public.customer c
                        JOIN public.users u ON c.cust_account = u.accountnum
                        WHERE c.cust_id = ?");
$stmt->execute([$bill_id]);
$row = $stmt->fetch();

if ($row) {
    echo json_encode([
        "success" => true,
        "id" => (string)$row['cust_id'],
        "name" => $row['name'],
        "accountnum" => $row['accountnum'],
        "address" => $row['address'],
        "total" => (string)$row['amount'],
        "duedate" => $row['due_date'],
        "month" => $row['billing_month'],
        "previous" => (string)$row['prreading'],
        "present" => (string)$row['creading'],
        "consumed" => (string)$row['treading'],
        "status" => $row['status']
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Bill not found"]);
}

$stmt = null;
$conn = null;
?>
