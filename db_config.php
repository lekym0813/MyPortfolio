<?php
$host = getenv("DB_HOST");
$port = getenv("DB_PORT");
$dbname = getenv("DB_NAME");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");

if (!$host && file_exists(__DIR__ . '/db_local.php')) {
    require_once __DIR__ . '/db_local.php';
}

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . $e->getMessage()]));
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
?>
