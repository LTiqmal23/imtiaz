
<?php

// Database connection
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "imtiaz";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>