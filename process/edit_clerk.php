<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clerkID = $_POST['clerkID'];
    $clerkName = $_POST['clerkName'];
    $clerkPhone = $_POST['clerkPhone'];

    $sql = "UPDATE clerk SET clerkName='$clerkName', clerkPhone='$clerkPhone' WHERE clerkID='$clerkID'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }

    $conn->close();
    header('Location: ../StaffStaff.php'); 
}
?>
