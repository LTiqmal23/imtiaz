<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studID = $_POST['studID'];
    $studName = $_POST['studName'];
    $studDOB = $_POST['studDOB'];
    $studPhone = $_POST['studPhone'];

    $sql = "UPDATE student SET studName='$studName', studDOB='$studDOB', studPhone='$studPhone' WHERE studID='$studID'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }

    $conn->close();
    header('Location: ../StaffStudent.php'); 
    exit();
}
?>
