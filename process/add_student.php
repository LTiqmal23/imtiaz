<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studIC = $_POST['studIC'];
    $studName = $_POST['studName'];
    $studDOB = $_POST['studDOB'];
    $studPhone = $_POST['studPhone'];
    $studEmail = $_POST['studEmail'];
    $studPassword = $_POST['studPassword'];
    $studAddress = 'N/A';
    $studRace = 'N/A';

    $sql = "INSERT INTO student (studIC ,studName, studDOB, studAddress, studRace, studPhone, studEmail, studPassword) VALUES ('$studIC' ,'$studName', '$studDOB','$studAddress', '$studRace' ,'$studPhone', '$studEmail', '$studPassword')";
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
