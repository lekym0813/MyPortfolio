<?php
header('Content-Type: application/json');
require_once('db.php');

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$address = $_POST['address'] ?? '';
$contact = $_POST['contact'] ?? '';
$accountnum = $_POST['accountnum'] ?? '';

if (empty($name) || empty($email) || empty($password) || empty($accountnum)) {
    echo json_encode(['success' => false, 'message' => 'Name, email, password, and account number are required']);
    exit;
}

$duplicate = $conn->prepare("SELECT id FROM users WHERE accountnum = ?");
$duplicate->execute([$accountnum]);

if ($duplicate->rowCount() > 0) {
    echo json_encode(['success' => false, 'message' => 'Account number already registered']);
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (email, password, name, accountnum, address, users_Pnumber) VALUES (?, ?, ?, ?, ?, ?)");

if ($stmt->execute([$email, $hashed_password, $name, $accountnum, $address, $contact])) {
    echo json_encode(['success' => true, 'message' => 'Registration successful']);
} else {
    echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $stmt->errorInfo()[2]]);
}
?>