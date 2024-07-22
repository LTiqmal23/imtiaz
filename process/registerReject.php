<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$ID = $_GET['rejectID'];
$clerkID = $_SESSION['clerkID'];

if (isset($_GET['rejectID'])) {
    include 'db.php';

    try {
        // Begin a transaction
        $conn->begin_transaction();

        // Update the ACCEPT table
        $sql = "update REGISTER SET registerStatus = 'REJECTED', clerkID = ? WHERE registerID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $clerkID, $ID);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Close statements and connection
        $stmt->close();
        $conn->close();

        // Redirect with success message
        echo "<script>
            alert('Application has been rejected');
            window.location.href = '../StaffRegister.php';
        </script>";
    } catch (Exception $e) {
        // Rollback the transaction if any error occurs
        $conn->rollback();

        // Close statements and connection
        if (isset($stmt)) $stmt->close();
        $conn->close();

        // Redirect with error message
        echo "<script>
            alert('Failed to reject application');
            window.history.back();
        </script>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accept</title>
</head>

<body>

</body>

</html>