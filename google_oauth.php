<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    $host = getenv("DB_HOST") ?: "aws-1-ap-southeast-1.pooler.supabase.com";
    $port = getenv("DB_PORT") ?: "5432";
    $dbname = getenv("DB_NAME") ?: "postgres";
    $username = getenv("DB_USER") ?: "postgres.jbktcpvtelogutmbeycv";
    $password = getenv("DB_PASSWORD") ?: "Supergwapo@23";
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    session_start();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['credential'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid request']);
        exit;
    }

    if (!function_exists('curl_init')) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'cURL extension is not available']);
        exit;
    }

    $credential = $_POST['credential'];

    $verify_url = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . urlencode($credential);
    $ch = curl_init();
    if ($ch === false) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Failed to initialize cURL']);
        exit;
    }

    curl_setopt_array($ch, [
        CURLOPT_URL => $verify_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    if ($curl_error) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'cURL error: ' . $curl_error]);
        exit;
    }

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

    $stmt = $conn->prepare("SELECT * FROM guest_users WHERE google_id = ?");
    $stmt->execute([$google_id]);
    $guest = $stmt->fetch();

    if ($guest) {
        $_SESSION['guest_id'] = $guest['id'];
        $_SESSION['guest_email'] = $guest['email'];
        $_SESSION['guest_name'] = $guest['name'];
        $_SESSION['user_type'] = 'guest';
    } else {
        $stmt = $conn->prepare("INSERT INTO guest_users (google_id, email, name) VALUES (?, ?, ?)");
        $stmt->execute([$google_id, $email, $name]);
        $guest_id = $conn->lastInsertId();

        $_SESSION['guest_id'] = $guest_id;
        $_SESSION['guest_email'] = $email;
        $_SESSION['guest_name'] = $name;
        $_SESSION['user_type'] = 'guest';
    }

    echo json_encode(['success' => true, 'redirect' => 'guest_main.php']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}
