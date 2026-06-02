<?php
session_start();
include 'db.php';
if (isset($_POST['submit'])){
    $name =  $_POST['accountname'];
    $accountnum = $_POST['accountnum'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $complaint = $_POST['complaint'];
    $user_id=$_SESSION['user_id'];
   


$sql = "INSERT INTO complaint (user_id, name, accountnumber, address, contact, complaint) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt->execute([$user_id, $name, $accountnum, $address, $contact, $complaint])) {
    echo '<script language="javascript">';
    echo 'alert("Application Submitted Succesfully")';
    echo '</script>';
} else {
    echo "Error: " . $conn->errorInfo()[2];
}
}
?>