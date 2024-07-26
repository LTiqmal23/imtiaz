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
    $stuGender = $_POST['stuGender'];
    $stuAge = $_POST['stuAge'];
    $studPostcode = $_POST['studPostcode'];
    $studCity = $_POST['studCity'];
    $studAddress = $_POST['studAddress'];
    $studParentName = $_POST['studParentName'];
    $studParentNo = $_POST['studParentNo'];

    $sql = "UPDATE student SET studName=?, studIC=?, studDOB=?, studPhone=?, studRace=?, studEmail=?, stuGender=?, stuAge=?, studPostcode=?, studCity=?, studAddress=?, studParentName=?, studParentNo=? WHERE studID=?";
    if (!empty($studPassword)) {
        $sql = "UPDATE student SET studName=?, studIC=?, studDOB=?, studPhone=?, studRace=?, studEmail=?, studPassword=?, stuGender=?, stuAge=?, studPostcode=?, studCity=?, studAddress=?, studParentName=?, studParentNo=? WHERE studID=?";
    }

    $stmt = $conn->prepare($sql);

    if (!empty($studPassword)) {
        $hashedPassword = password_hash($studPassword, PASSWORD_BCRYPT);
        $stmt->bind_param("ssssssssssssssi", $studName, $studIC, $studDOB, $studPhone, $studRace, $studEmail, $hashedPassword, $stuGender, $stuAge, $studPostcode, $studCity, $studAddress, $studParentName, $studParentNo, $studID);
    } else {
        $stmt->bind_param("sssssssssssssi", $studName, $studIC, $studDOB, $studPhone, $studRace, $studEmail, $stuGender, $stuAge, $studPostcode, $studCity, $studAddress, $studParentName, $studParentNo, $studID);
    }

    if ($stmt->execute() === TRUE) {
        $_SESSION['message'] = "Profile updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }

    $stmt->close();
    $conn->close();
    header('Location: ../StudentProfile.php');
    exit();
}
?>
