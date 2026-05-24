<?php
include 'db.php';
if (isset($_POST['register'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $name = $_POST['name'];
    $accountnum = $_POST['accountnum'];
    $address = $_POST['address'];
    $users_Pnumber = $_POST['users_Pnumber'];

    if ($password !== $password2) {
        echo '<script language="javascript">';
        echo 'alert("Passwords do not match")';
        echo '</script>';
        exit;
    }

$duplicate = $conn->prepare("SELECT * FROM users WHERE accountnum = ?");
$duplicate->execute([$accountnum]);
if ($duplicate->rowCount() > 0)
{
    echo '<script language="javascript">';
    echo 'alert("Account Number Already Register")';
    echo '</script>';

} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (email, password, name, accountnum, address, users_Pnumber) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt->execute([$email, $hashed_password, $name, $accountnum, $address, $users_Pnumber])) {
        echo '<script language="javascript">';
        echo 'alert("Registration Succesfull")';
        echo '</script>';
    } else {
        echo 'alert("Registration failed")';
    }
}
}
?>
