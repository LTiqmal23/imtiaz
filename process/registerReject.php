<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (isset($_POST['rejectID'])) {
    $ID = $_POST['rejectID'];
    $clerkID = $_SESSION['clerkID'];
    $rejectMessage = $_POST['rejectMessage'];

    include 'db.php';

    try {
        // Begin a transaction
        $conn->begin_transaction();

        // Update the REGISTER table
        $sql = "UPDATE REGISTER SET registerStatus = 'REJECTED', registerDesc = ?, clerkID = ? WHERE registerID = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        $stmt->bind_param("sii", $rejectMessage, $clerkID, $ID);
        if ($stmt->execute() === false) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

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

        // Output error message
        echo "<script>
            alert('Failed to reject application: " . addslashes($e->getMessage()) . "');
            window.history.back();
        </script>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reject</title>
</head>

<body>

</body>

</html>