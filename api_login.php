<?php
header('Content-Type: application/json');
require_once('db.php');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required']);
    exit;
}

$sql = "SELECT id, name, email, password, accountnum, address, users_Pnumber FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);
$row = $stmt->fetch();

if ($row && password_verify($password, $row['password'])) {
    unset($row['password']);
    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'user_id' => $row['id'],
        'name' => $row['name'],
        'accountnum' => $row['accountnum'],
        'address' => $row['address'] ?? '',
        'users_Pnumber' => $row['users_Pnumber'] ?: null
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
}
?>