<!DOCTYPE html>
<?php
// database connection
include 'db.php';
session_start();
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
        // Student found, set session variables and redirect to student home page
        $row = $result->fetch_assoc();
        $_SESSION['studID'] = $row['studID'];
        $_SESSION['studName'] = $row['studName'];
        header("Location: ../StudentHome.php");
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
        $row = $result->fetch_assoc();
        $_SESSION['clerkID'] = $row['clerkID'];
        $_SESSION['clerkName'] = $row['clerkName'];
        header("Location: ../StaffDashboard.php");
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
