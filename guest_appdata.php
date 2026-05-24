<?php
require_once 'guest_session.php';
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'guest') {
  header('Location: guest_login.php');
  exit();
}

if (isset($_POST['apply'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $occupation = $_POST['occupation'];
    $bday = $_POST['bday'];
    $classification = $_POST['classification'];
    $connection = $_POST['connection'];
    $user_id = $_SESSION['guest_id'];

    $file_name = $_FILES['files']['name'];
    if ($file_name) {
        $file_type = $_FILES['files']['type'];
        $file_size = $_FILES['files']['size'];
        $file_tem_loc = $_FILES['files']['tmp_name'];
        $file_store = "upload/" . basename($file_name);
        move_uploaded_file($file_tem_loc, $file_store);
    }

    $sql = "INSERT INTO application (user_id, fname, lname, address, contact, occupation, bday, class, conntype)
            VALUES (:user_id, :fname, :lname, :address, :contact, :occupation, :bday, :class, :conntype)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':fname' => $fname,
            ':lname' => $lname,
            ':address' => $address,
            ':contact' => $contact,
            ':occupation' => $occupation,
            ':bday' => $bday,
            ':class' => $classification,
            ':conntype' => $connection,
        ]);
        echo '<script language="javascript">';
        echo 'alert("Application Submitted Successfully");';
        echo 'window.location.href="guest_main.php";';
        echo '</script>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
