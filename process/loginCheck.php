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
    $sql_student = "SELECT * FROM student WHERE studEmail = ? AND studPassword = ?";
    $stmt_student = $conn->prepare($sql_student);
    $stmt_student->bind_param("ss", $email, $password);
    $stmt_student->execute();
    $result_student = $stmt_student->get_result();

    if ($result_student->num_rows > 0) {
        // Student found, set session variables
        $row_student = $result_student->fetch_assoc();
        $_SESSION['studID'] = $row_student['studID'];
        $_SESSION['studName'] = $row_student['studName'];

        // Check if student has any pending or rejected registrations
        $studID = $row_student['studID'];
        $sql_status = "SELECT registerStatus FROM REGISTER WHERE studID = ? ORDER BY registerDate DESC LIMIT 1";
        $stmt_status = $conn->prepare($sql_status);
        $stmt_status->bind_param("s", $studID);
        $stmt_status->execute();
        $result_status = $stmt_status->get_result();

        if ($result_status->num_rows > 0) {
            $row_status = $result_status->fetch_assoc();
            $status = $row_status['registerStatus'];

            if ($status == 'PENDING') {
                header("Location: ../StudentPending.php");
            } else if ($status == 'REJECTED') {
                header("Location: ../StudentRejected.php");
            } else {
                header("Location: ../StudentHome.php");
            }
        } else {
            // No registration record found, redirect to student home page
            header("Location: ../StudentPending.php");
        }
        exit();
    }

    // Reset variables before checking clerk credentials
    $stmt_student->close();
    $result_student->close();

    // Check credentials against clerk table
    $sql_clerk = "SELECT * FROM clerk WHERE clerkEmail = ? AND clerkPassword = ?";
    $stmt_clerk = $conn->prepare($sql_clerk);
    $stmt_clerk->bind_param("ss", $email, $password);
    $stmt_clerk->execute();
    $result_clerk = $stmt_clerk->get_result();

    if ($result_clerk->num_rows > 0) {
        // Clerk found, set session variables
        $row_clerk = $result_clerk->fetch_assoc();
        $_SESSION['clerkID'] = $row_clerk['clerkID'];
        $_SESSION['clerkName'] = $row_clerk['clerkName'];
        header("Location: ../StaffDashboard.php");
        exit();
    }

    // Reset variables before checking principal credentials
    $stmt_clerk->close();
    $result_clerk->close();

    // Check credentials against principal table
    $sql_principal = "SELECT * FROM principal WHERE principalEmail = ? AND principalPassword = ?";
    $stmt_principal = $conn->prepare($sql_principal);
    $stmt_principal->bind_param("ss", $email, $password);
    $stmt_principal->execute();
    $result_principal = $stmt_principal->get_result();

    if ($result_principal->num_rows > 0) {
        // Principal found, set session variables
        $row_principal = $result_principal->fetch_assoc();
        $_SESSION['principalID'] = $row_principal['principalID'];
        $_SESSION['principalName'] = $row_principal['principalName'];
        header("Location: ../PrincipalDashboard.php");
        exit();
    }

    // If no match found in any table, show an error message
    echo "<script>
        alert('Invalid username or password');
        window.location.href = '../MainLogin.html';
    </script>";

    $stmt_principal->close();
    $result_principal->close();
    $conn->close();
}
?>