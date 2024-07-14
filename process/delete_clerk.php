<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clerkID = $_POST['clerkID'];

    $sql = "DELETE FROM clerk WHERE clerkID='$clerkID'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record deleted successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }

    $conn->close();
    header('Location: ../StaffStaff.php'); 
}
?>
