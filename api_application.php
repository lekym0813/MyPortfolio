<?php
header('Content-Type: application/json');
require_once('db_config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
    exit;
}

$user_id = $_POST['user_id'] ?? '';
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$address = $_POST['address'] ?? '';
$contact = $_POST['contact'] ?? '';
$occupation = $_POST['occupation'] ?? '';
$bday = $_POST['bday'] ?? '';
$classification = $_POST['classification'] ?? '';
$connection = $_POST['connection'] ?? '';

$json = file_get_contents('php://input');
$data = json_decode($json, true);
if ($data) {
    $user_id = $data['user_id'] ?? $user_id;
    $fname = $data['fname'] ?? $fname;
    $lname = $data['lname'] ?? $lname;
    $address = $data['address'] ?? $address;
    $contact = $data['contact'] ?? $contact;
    $occupation = $data['occupation'] ?? $occupation;
    $bday = $data['bday'] ?? $bday;
    $classification = $data['classification'] ?? $classification;
    $connection = $data['connection'] ?? $connection;
}

if (empty($user_id) || empty($fname) || empty($lname) || empty($address) || empty($contact) || empty($occupation) || empty($bday) || empty($classification) || empty($connection)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO public.application (user_id, fname, lname, address, contact, occupation, bday, class, conntype, status, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', NOW())");
$stmt->execute([$user_id, $fname, $lname, $address, $contact, $occupation, $bday, $classification, $connection]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["success" => true, "message" => "Application submitted successfully"]);
} else {
    $err = $stmt->errorInfo();
    echo json_encode(["success" => false, "message" => "Failed to submit application: " . ($err[2] ?? 'Unknown error')]);
}

$stmt = null;
$conn = null;
?>