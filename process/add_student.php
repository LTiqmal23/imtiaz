<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studID = $_POST['studID'];
    $studName = $_POST['studName'];
    $studDOB = $_POST['studDOB'];
    $studPhone = $_POST['studPhone'];

    $sql = "INSERT INTO student (studID, studName, studDOB, studPhone) VALUES ('$studID', '$studName', '$studDOB', '$studPhone')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "New record created successfully";
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
