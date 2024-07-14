<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clerkID = $_POST['clerkID'];
    $clerkName = $_POST['clerkName'];
    $clerkPhone = $_POST['clerkPhone'];

    $sql = "INSERT INTO clerk (clerkID, clerkName, clerkPhone) VALUES ('$clerkID', '$clerkName', '$clerkPhone')";
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
?>
