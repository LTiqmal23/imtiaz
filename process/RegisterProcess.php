<?php

include 'db.php';

$email = $_POST['email'];
$fullname = $_POST['fullname'];
$ic = $_POST['ic'];
$password = $_POST['password'];
$date = date('Y-m-d'); // Assuming the registration date is the current date

try {
    // Begin a transaction
    $conn->begin_transaction();

    // Insert into STUDENT table
    $sql2 = "INSERT INTO STUDENT (studName, studIC, studEmail, studPassword) VALUES (?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("ssss", $fullname, $ic, $email, $password);
    $stmt2->execute();

    // Generate a unique ID for the REGISTER table (assuming studID is the unique identifier)
    $id = $conn->insert_id;

    // Insert into REGISTER table
    $sql = "INSERT INTO REGISTER (registerDate, studID) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $date, $id);
    $stmt->execute();

    // Commit the transaction
    $conn->commit();

    // Close statements and connection
    $stmt2->close();
    $stmt->close();
    $conn->close();

    // Redirect with success message
    echo "<script>
        alert('Registration successful. Please login to continue');
        window.location.href = '../MainLogin.html';
    </script>";
} catch (Exception $e) {
    // Rollback the transaction if any error occurs
    $conn->rollback();

    // Close statements and connection
    if (isset($stmt2)) $stmt2->close();
    if (isset($stmt)) $stmt->close();
    $conn->close();

    // Redirect with error message
    echo "<script>
        alert('Failed to register');
        window.history.back();
    </script>";
}
?>
