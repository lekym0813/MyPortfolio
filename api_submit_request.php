<?php
header('Content-Type: application/json');
require_once('db_config.php');

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

$json = file_get_contents('php://input');
$data = json_decode($json, true);
if ($data) {
    $user_id = $data['user_id'] ?? $user_id;
    $name = $data['name'] ?? $name;
    $account_number = $data['account_number'] ?? $account_number;
    $contact = $data['contact'] ?? $contact;
    $address = $data['address'] ?? $address;
    $request_type = $data['request_type'] ?? $request_type;
    $description = $data['description'] ?? $description;
}

$user_id = trim($user_id);
$name = trim($name);
$account_number = trim($account_number);
$contact = trim($contact);
$address = trim($address);
$request_type = trim($request_type);
$description = trim($description);

if (empty($user_id) || empty($name)) {
    echo json_encode(["success" => false, "message" => "Required fields are missing"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO public.application (user_id, fname, address, contact, occupation, status, date) VALUES (?, ?, ?, ?, ?, 'Pending', NOW())");
$stmt->execute([$user_id, $name, $address, $contact, $request_type]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["success" => true, "message" => "Service request submitted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to submit request"]);
}

$stmt = null;
$conn = null;
?>
