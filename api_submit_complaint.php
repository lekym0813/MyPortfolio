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
$complaint_type = $_POST['complaint_type'] ?? '';
$complaint_text = $_POST['complaint_text'] ?? '';

$json = file_get_contents('php://input');
$data = json_decode($json, true);
if ($data) {
    $user_id = $data['user_id'] ?? $user_id;
    $name = $data['name'] ?? $name;
    $account_number = $data['account_number'] ?? $account_number;
    $contact = $data['contact'] ?? $contact;
    $address = $data['address'] ?? $address;
    $complaint_type = $data['complaint_type'] ?? $complaint_type;
    $complaint_text = $data['complaint_text'] ?? $complaint_text;
}

$user_id = trim($user_id);
$name = trim($name);
$account_number = trim($account_number);
$contact = trim($contact);
$address = trim($address);
$complaint_type = trim($complaint_type);
$complaint_text = trim($complaint_text);

if (empty($user_id) || empty($name) || empty($account_number)) {
    echo json_encode(["success" => false, "message" => "Required fields are missing"]);
    exit;
}

$complaint = $complaint_type;
if (!empty($complaint_text)) {
    $complaint .= ": " . $complaint_text;
}

$stmt = $conn->prepare("INSERT INTO public.complaint (user_id, name, accountnumber, contact, address, complaint, status, date) VALUES (?, ?, ?, ?, ?, ?, 'Pending', NOW())");
$stmt->execute([$user_id, $name, $account_number, $contact, $address, $complaint]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["success" => true, "message" => "Complaint submitted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to submit complaint"]);
}

$stmt = null;
$conn = null;
?>
