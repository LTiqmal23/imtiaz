<!DOCTYPE html>
<?php
// database connection
include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Check credentials against student table
    $sql = "SELECT * FROM student WHERE studEmail = ? AND studPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Student found, set session variables
        $row = $result->fetch_assoc();
        $_SESSION['studID'] = $row['studID'];
        $_SESSION['studName'] = $row['studName'];

        // Check if student has any pending or rejected registrations
        $studID = $row['studID'];
        $sql_status = "SELECT registerStatus FROM REGISTER WHERE studID = ? ORDER BY registerDate DESC LIMIT 1";
        $stmt_status = $conn->prepare($sql_status);
        $stmt_status->bind_param("s", $studID);
        $stmt_status->execute();
        $result_status = $stmt_status->get_result();

        if ($result_status->num_rows > 0) {
            $row_status = $result_status->fetch_assoc();
            $status = $row_status['registerStatus'];

            if ($status == 'PENDING' || $status == 'REJECTED') {
                header("Location: ../StudentPending.php");
            } else {
                header("Location: ../StudentHome.php");
            }
        } else {
            // No registration record found, redirect to student home page
            header("Location: ../StudentPending.php");
        }
    } else {
        // Invalid credentials, redirect back to login page with error message
        echo "<script>
        alert('Invalid username or password');
        window.location.href = '../MainLogin.html';
    </script>";
    }

    // Check credentials against clerk table
    $sql = "SELECT * FROM clerk WHERE clerkEmail = ? AND clerkPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
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
    $sql = "SELECT * FROM principal WHERE principalEmail = ? AND principalPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Principal found, redirect to principal home page
        $row = $result->fetch_assoc();
        $_SESSION['principalID'] = $row['principalID'];
        $_SESSION['principalName'] = $row['principalName'];
        header("Location: ../PrincipalDashboard.php");
        exit();
    }

    // If no match found, show an error message
    echo "Invalid username or password";

    $stmt->close();
    $conn->close();
}
?>