<?php
require_once 'db.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['credential'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit;
}

$credential = $_POST['credential'];

// Verify the Google ID token using Google's tokeninfo endpoint
$verify_url = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . urlencode($credential);
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $verify_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_SSL_VERIFYPEER => true,
]);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code !== 200) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Token verification failed']);
    exit;
}

$payload = json_decode($response, true);
if (!$payload || !isset($payload['sub'], $payload['email'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Invalid token payload']);
    exit;
}

$expected_client_id = '19478160697-b7s161njn4n7lnfad4mrhdh6hpvfo27n.apps.googleusercontent.com';
if ($payload['aud'] !== $expected_client_id) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Token audience mismatch']);
    exit;
}

$google_id = $payload['sub'];
$email = $payload['email'];
$name = $payload['name'] ?? $email;

// Check if guest user already exists
$stmt = $conn->prepare("SELECT * FROM guest_users WHERE google_id = ?");
$stmt->execute([$google_id]);
$guest = $stmt->fetch();

if ($guest) {
    // Existing guest — log them in
    $_SESSION['guest_id'] = $guest['id'];
    $_SESSION['guest_email'] = $guest['email'];
    $_SESSION['guest_name'] = $guest['name'];
    $_SESSION['user_type'] = 'guest';
} else {
    // New guest — create account
    $stmt = $conn->prepare("INSERT INTO guest_users (google_id, email, name) VALUES (?, ?, ?)");
    $stmt->execute([$google_id, $email, $name]);
    $guest_id = $conn->lastInsertId();

    $_SESSION['guest_id'] = $guest_id;
    $_SESSION['guest_email'] = $email;
    $_SESSION['guest_name'] = $name;
    $_SESSION['user_type'] = 'guest';
}

echo json_encode(['success' => true, 'redirect' => 'guest_main.php']);
