<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
    exit();
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$address = $_POST['address'] ?? '';
$contact = $_POST['contact'] ?? '';
$accountnum = $_POST['accountnum'] ?? '';

$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);
if ($data) {
    $name = $data['name'] ?? $name;
    $email = $data['email'] ?? $email;
    $password = $data['password'] ?? $password;
    $address = $data['address'] ?? $address;
    $contact = $data['contact'] ?? $contact;
    $accountnum = $data['accountnum'] ?? $accountnum;
}

$name = trim($name);
$email = trim($email);
$password = trim($password);
$address = trim($address);
$contact = trim($contact);
$accountnum = trim($accountnum);

if (empty($name) || empty($email) || empty($password) || empty($address) || empty($contact) || empty($accountnum)) {
    $missing = [];
    if (empty($name)) $missing[] = "name";
    if (empty($email)) $missing[] = "email";
    if (empty($password)) $missing[] = "password";
    if (empty($address)) $missing[] = "address";
    if (empty($contact)) $missing[] = "contact";
    if (empty($accountnum)) $missing[] = "accountnum";

    echo json_encode([
        "success" => false,
        "message" => "Required fields missing: " . implode(", ", $missing),
        "received_post" => $_POST,
        "raw_input" => $rawInput
    ]);
    exit();
}

$check = $conn->prepare("SELECT id FROM public.users WHERE email = ? OR accountnum = ?");
$check->execute([$email, $accountnum]);

if ($check->fetch()) {
    echo json_encode(["success" => false, "message" => "Email or account number already exists"]);
    $check = null;
    $conn = null;
    exit();
}
$check = null;

$hashed = password_hash($password, PASSWORD_BCRYPT);
$stmt = $conn->prepare("INSERT INTO public.users (name, email, password, address, users_pnumber, accountnum) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$name, $email, $hashed, $address, $contact, $accountnum]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["success" => true, "message" => "Registration successful"]);
} else {
    $err = $stmt->errorInfo();
    echo json_encode(["success" => false, "message" => "Registration failed: " . ($err[2] ?? 'Unknown error')]);
}

$stmt = null;
$conn = null;
?>
