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
$request_type = $_POST['request_type'] ?? '';
$description = $_POST['description'] ?? '';

if (empty($user_id) || empty($name)) {
    echo json_encode(["success" => false, "message" => "Required fields are missing"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO application (user_id, fname, address, contact, occupation, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
$occupation = $request_type;

if ($stmt->execute([$user_id, $name, $address, $contact, $occupation])) {
    echo json_encode(["success" => true, "message" => "Service request submitted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to submit request"]);
}
?>
