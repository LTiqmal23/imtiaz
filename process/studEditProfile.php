<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studID = $_POST['studID'];
    $studName = $_POST['studName'];
    $studGender = $_POST['studGender'];  // Add address
    $studDOB = $_POST['studDOB'];
    $studPhone = $_POST['studPhone'];
    $studRace = $_POST['studRace'];  // Add race
    $studState = $_POST['studState'];
    $studDistrict = $_POST['studDistrict'];
    $studPoscode = $_POST['studPoscode'];
    $studAddress = $_POST['studAddress'];

    $sql = "update student SET studName=?,studGender=?, studDOB=?, studPhone=?, studRace=?, studState=?, studDistrict=?, studPoscode=?,studAddress=? WHERE studID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssisi", $studName, $studGender, $studDOB, $studPhone, $studRace, $studState, $studDistrict, $studPoscode, $studAddress, $studID);

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
