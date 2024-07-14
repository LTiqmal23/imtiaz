<!DOCTYPE html>
<html lang="en">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['ID'])) {
        echo "<script>alert('Log In First');</script>";
        header("Location: login.html");
        exit();
    }

    $studID = $_SESSION['ID'];

    include "db.php";
    // value from form
    $name  = $_POST['name'];
    $IC  = $_POST['IC'];
    $dob  = $_POST['DOB'];
    $phone  = $_POST['phone'];
    $address  = $_POST['address'];
    $race  = $_POST['race'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];
    // SQL for execution
    $stmt = $conn->prepare("insert into `student`(`studName`, `studIC`, `studDOB`, `studPhone`, `studAddress`, `studRace`, `studUsername`, `studPassword`) 
    VALUES (?,?,?,?,?,?,?,?");

    if ($stmt) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssssss", $name, $IC, $DOB, $phone, $address, $race, $username, $password);

        // Execute the prepared statement
        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Register</title>
</head>

<body>

</body>

</html>