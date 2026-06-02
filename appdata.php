<?php
session_start();
include 'db.php';
if (isset($_POST['apply'])){
    $fname =  $_POST['fname'];
    $lname =  $_POST['lname'];
    $address = $_POST['address'];
    $contact =  $_POST['contact'];
    $occupation = $_POST['occupation'];
    $bday = $_POST['bday'];
    $classification = $_POST['classification'];
    $connection = $_POST['connection'];
    $user_id=$_SESSION['user_id'];
    
    


$sql = "INSERT INTO application (user_id, fname, lname, address, contact, occupation, bday, class, conntype )
VALUES ('$user_id','$fname', ' $lname', '$address', '$contact', '$occupation', '$bday', '$classification', '$connection')";

try {
    $conn->exec($sql);
    echo '<script language="javascript">';
    echo 'alert("Application Submitted Succesfully")';
    echo '</script>';
} catch (PDOException $e) {
    echo "Error: " . $sql . "<br>" . $conn->errorInfo()[2];
}
}
?>