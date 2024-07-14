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

$clerkID = $_SESSION['ID'];

include "db.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST['name'];
    $newPhone = $_POST['phone'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];

    // Validate the input
    if (empty($newName)) {
        echo "<script>alert('Name cannot be empty');</script>";
    } else {
        // Update the database
        $updateSql = "update clerk SET clerkName=?, clerkPhone=?,
        clerkUsername=?, clerkPassword=? where clerkID = ?";

        if ($updateStmt = $conn->prepare($updateSql)) {
            $updateStmt->bind_param("ssssi", $newName, $newPhone, $newUsername, $newPassword, $clerkID);

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