<?php
header('Content-Type: application/json');
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
    exit;
}

$user_id = $_POST['user_id'] ?? '';
$name = $_POST['name'] ?? '';
$account_number = $_POST['account_number'] ?? '';
$contact = $_POST['contact'] ?? '';
$address = $_POST['address'] ?? '';
$complaint_type = $_POST['complaint_type'] ?? '';
$complaint_text = $_POST['complaint_text'] ?? '';

if (empty($user_id) || empty($name) || empty($account_number)) {
    echo json_encode(["success" => false, "message" => "Required fields are missing"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO complaint (user_id, name, accountnumber, contact, address, complaint, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')");

if ($stmt->execute([$user_id, $name, $account_number, $contact, $address, $complaint_type])) {
    echo json_encode(["success" => true, "message" => "Complaint submitted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to submit complaint"]);
}
?>
