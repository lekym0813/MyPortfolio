<?php
// Load environment variables from .env file
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

$host = getenv("DB_HOST") ?: "localhost";
$port = getenv("DB_PORT") ?: "5432";
$dbname = getenv("DB_NAME") ?: "postgres";
$username = getenv("DB_USER") ?: "postgres";
$password = getenv("DB_PASSWORD") ?: "";

try {
    // Use connection string with IPv4 address family
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require;options='-c statement_timeout=30000'";
    $conn = new PDO($dsn, $username, $password, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 10
    ));
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
