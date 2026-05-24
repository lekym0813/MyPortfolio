<?php
$host = getenv("DB_HOST") ?: "aws-1-ap-southeast-1.pooler.supabase.com";
$port = getenv("DB_PORT") ?: "5432";
$dbname = getenv("DB_NAME") ?: "postgres";
$username = getenv("DB_USER") ?: "postgres.jbktcpvtelogutmbeycv";
$password = getenv("DB_PASSWORD") ?: "Supergwapo@23";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>