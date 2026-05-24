<?php
require_once('db.php');
session_start();

if (isset($_POST['loginAdmin'])){
    $user = $_POST['user'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT * FROM admin WHERE "user" = ?');
    $stmt->execute([$user]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['user'] = $admin['user'];
        header('location: admin.php');
    } else {
        echo '<script language="javascript">';
        echo 'alert("Wrong Username and Password")';
        echo '</script>';
    }
}
?>