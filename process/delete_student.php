<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studID = $_POST['studID'];

    $sql = "DELETE FROM student WHERE studID='$studID'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record deleted successfully";
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
