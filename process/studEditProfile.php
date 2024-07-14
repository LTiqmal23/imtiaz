<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studID = $_POST['studID'];
    $studName = $_POST['studName'];
    $studDOB = $_POST['studDOB'];
    $studPhone = $_POST['studPhone'];
    $studRace = $_POST['studRace'];  // Add race
    $studAddress = $_POST['studAddress'];  // Add address

    $sql = "UPDATE student SET studName=?, studDOB=?, studPhone=?, studRace=?, studAddress=? WHERE studID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $studName, $studDOB, $studPhone, $studRace, $studAddress, $studID);

    if ($stmt->execute() === TRUE) {
        $_SESSION['message'] = "Profile updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }

    $stmt->close();
    $conn->close();
    header('Location: ../studentProfile.php');
    exit();
}
?>
