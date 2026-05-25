<?php
$host = getenv("DB_HOST") ?: "aws-1-ap-southeast-1.pooler.supabase.com";
$port = getenv("DB_PORT") ?: "5432";
$dbname = getenv("DB_NAME") ?: "postgres";
$username = getenv("DB_USER") ?: "postgres.jbktcpvtelogutmbeycv";
$password = getenv("DB_PASSWORD") ?: "Supergwapo@23";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS public.guest_users (
        id SERIAL PRIMARY KEY,
        google_id TEXT NOT NULL UNIQUE,
        email TEXT NOT NULL,
        name TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "<h2>Success!</h2><p>The <code>guest_users</code> table has been created.</p>";
} catch (PDOException $e) {
    echo "<h2>Error</h2><p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
