<!DOCTYPE html>
<?php
// database connection
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Check credentials against student table
    $sql = "SELECT * FROM student WHERE studUsername = ? AND studPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Student found, redirect to student home page
        header("Location: studentHome.php");
        exit();
    }

    // Check credentials against clerk table
    $sql = "SELECT * FROM clerk WHERE clerkUsername = ? AND clerkPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Clerk found, redirect to clerk home page
        header("Location: clerkHome.php");
        exit();
    }

    // Check credentials against principal table
    $sql = "SELECT * FROM principal WHERE principalUsername = ? AND principalPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Principal found, redirect to principal home page
        header("Location: principalHome.php");
        exit();
    }

    // If no match found, show an error message
    echo "Invalid username or password";

    $stmt->close();
    $conn->close();
}
?>
