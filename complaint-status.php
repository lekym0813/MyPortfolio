<?php
include 'db.php';
if (isset($_POST['update'])){
    $status =  $_POST['status'];

$sql = "UPDATE INTO complaint (status)
VALUES ('$status')";

try {
    $conn->exec($sql);
    echo '<script language="javascript">';
    echo 'alert("Complaint Updated")';
    echo '</script>';
} catch (PDOException $e) {
    echo "Error: " . $sql . "<br>" . $e->getMessage();
}
}
?>