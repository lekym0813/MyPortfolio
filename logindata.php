<?php
require_once('db.php');
session_start();

if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        header('location: usermain.php');
    } else {
        echo "<script> alert ('Wrong Password and Email');
        window.location.href='login.php'; </script>";
    }
}
?>