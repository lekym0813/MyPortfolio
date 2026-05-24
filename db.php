<?php
$host = "aws-1-ap-southeast-1.pooler.supabase.com";
$port = "5432";
$dbname = "postgres";
$username = "postgres.jbktcpvtelogutmbeycv";
$password = "Supergwapo@23";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>