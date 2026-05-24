<?php
require_once('db.php');
$check = $conn->prepare("SELECT COUNT(*) FROM admin WHERE user = ?");
$check->execute(['admin']);
if ($check->fetchColumn() == 0) {
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO admin (user, password) VALUES (?, ?)");
    $stmt->execute(['admin', $hash]);
    echo "Admin user created: admin / admin123";
} else {
    echo "Admin user already exists.";
}
