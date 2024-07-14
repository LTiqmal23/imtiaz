<!DOCTYPE html>
<html lang="en">
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['ID'])) {
    echo "<script>alert('Log In First');</script>";
    header("Location: login.html");
    exit();
}

$studID = $_SESSION['ID'];

include "db.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST['name'];
    $newAddress = $_POST['address'];
    $newPhone = $_POST['phone'];
    $newDOB = $_POST['DOB'];
    $newRace = $_POST['race'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];

    // Validate the input
    if (empty($newName)) {
        echo "<script>alert('Name cannot be empty');</script>";
    } else {
        // Update the database
        $updateSql = "update student SET studName=?, studDOB=?, studPhone=?,
        studAddress=?, studRace=?,studUsername=?, studPassword=? where studID = ?";

        if ($updateStmt = $conn->prepare($updateSql)) {
            $updateStmt->bind_param("sssssssi", $newName, $newDOB, $newPhone, $newAddress, $newRace, $newUsername, $newPassword, $studID);

            if ($updateStmt->execute()) {
                echo "<script>alert('Profile updated successfully!');</script>";
            } else {
                echo "<script>alert('Error updating profile. Please try again.');</script>";
            }

            $updateStmt->close();
        } else {
            echo "<script>alert('Error preparing statement.');</script>";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>

</body>

</html>