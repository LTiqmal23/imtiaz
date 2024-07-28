<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studID = $_POST['studID'];
    $studName = $_POST['studName'];
    $studIC = $_POST['studIC'];
    $studDOB = $_POST['studDOB'];
    $studPhone = $_POST['studPhone'];
    $studRace = $_POST['studRace'];
    $studEmail = $_POST['studEmail'];
    $studPassword = $_POST['studPassword'];
    $studGender = $_POST['studGender'];
    $studAge = $_POST['studAge'];
    $studPostcode = $_POST['studPostcode'];
    $studState = $_POST['studState'];
    $studDistrict = $_POST['studDistrict'];
    $studAddress = $_POST['studAddress'];
    $studParentName = $_POST['studParentName'];
    $studParentNo = $_POST['studParentNo'];

    if (!empty($studPassword)) {
        $sql = "UPDATE student SET studName=?, studIC=?, studDOB=?, studPhone=?, studRace=?, studEmail=?, studPassword=?, studGender=?, studAge=?, studPostcode=?, studState=?, studDistrict=?, studAddress=?, studParentName=?, studParentNo=? WHERE studID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssssi", $studName, $studIC, $studDOB, $studPhone, $studRace, $studEmail, $studPassword, $studGender, $studAge, $studPostcode, $studState, $studDistrict, $studAddress, $studParentName, $studParentNo, $studID);
    } else {
        $sql = "UPDATE student SET studName=?, studIC=?, studDOB=?, studPhone=?, studRace=?, studEmail=?, studGender=?, studAge=?, studPostcode=?, studState=?, studDistrict=?, studAddress=?, studParentName=?, studParentNo=? WHERE studID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssi", $studName, $studIC, $studDOB, $studPhone, $studRace, $studEmail, $studGender, $studAge, $studPostcode, $studState, $studDistrict, $studAddress, $studParentName, $studParentNo, $studID);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        error_log("Error executing statement: " . $stmt->error);
        $_SESSION['message'] = "Error executing statement.";
        $_SESSION['message_type'] = "danger";
    }

    $stmt->close();
    $conn->close();
    header('Location: ../studentProfile.php');
    exit();
}
?>
