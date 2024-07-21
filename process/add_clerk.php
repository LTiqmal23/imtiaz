<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clerkName = $_POST['clerkName'];
    $clerkPhone = $_POST['clerkPhone'];
    $clerkEmail = $_POST['clerkEmail'];
    $clerkPassword = $_POST['clerkPassword'];

    $sql = "INSERT INTO clerk (clerkName, clerkPhone, clerkEmail, clerkPassword) VALUES ('$clerkName', '$clerkPhone', '$clerkEmail', '$clerkPassword')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "New record created successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }

    $conn->close();
    header('Location: ../StaffStaff.php');
}
