<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
    exit();
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);
if ($data) {
    $email = $data['email'] ?? $email;
    $password = $data['password'] ?? $password;
}

$email = trim($email);
$password = trim($password);

if (empty($email) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "Email and password are required",
        "debug" => [
            "email_from_post" => $_POST['email'] ?? '(not set)',
            "password_from_post" => $_POST['password'] ?? '(not set)',
            "post_keys" => array_keys($_POST),
            "raw_input" => $rawInput ?? file_get_contents('php://input'),
            "json_decoded" => $data ?? null,
            "json_error" => json_last_error_msg(),
            "request_method" => $_SERVER['REQUEST_METHOD'],
            "content_type" => $_SERVER['CONTENT_TYPE'] ?? '(not set)'
        ]
    ]);
    exit();
}

$stmt = $conn->prepare("SELECT id, name, email, password, accountnum, users_pnumber, address FROM public.users WHERE email = ? OR accountnum = ?");
$stmt->execute([$email, $email]);
$row = $stmt->fetch();

if ($row) {
    $storedHash = $row['password'];
    $valid = false;

    if (str_starts_with($storedHash, '$2y$') || str_starts_with($storedHash, '$2a$') || str_starts_with($storedHash, '$2b$')) {
        $valid = password_verify($password, $storedHash);
    } else {
        $valid = md5($password) === $storedHash;
    }

    if ($valid) {
        echo json_encode([
            "success" => true,
            "message" => "Login successful",
            "user_id" => (string)$row['id'],
            "name" => $row['name'],
            "accountnum" => $row['accountnum'],
            "contact" => $row['users_pnumber'] ?? '',
            "address" => $row['address'] ?? ''
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid password"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "User not found"]);
}

$stmt = null;
$conn = null;
?>
