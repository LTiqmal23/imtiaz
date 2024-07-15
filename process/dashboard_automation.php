<!DOCTYPE html>
<?php
include 'db.php';
// Check if the connection is set and not null
if (!isset($conn) || $conn === null) {
    die("Database connection not established.");
}

// Total Student
$sqlStud = "SELECT COUNT(*) as total FROM student";
$stmtStud = $conn->prepare($sqlStud);
$stmtStud->execute();
$resStud = $stmtStud->get_result();

$totalStud = 0; // Initialize total variable

if ($resStud->num_rows > 0) {
    while ($row = $resStud->fetch_assoc()) {
        $totalStud = $row['total'];
    }
}

// Total Registration
$sqlReg = "SELECT COUNT(*) as total FROM register";
$stmtReg = $conn->prepare($sqlReg);
$stmtReg->execute();
$resReg = $stmtReg->get_result();

$totalReg = 0; // Initialize total variable

if ($resReg->num_rows > 0) {
    while ($row = $resReg->fetch_assoc()) {
        $totalReg = $row['total'];
    }
}

// Total Clerk
$sqlClerk = "SELECT COUNT(*) as total FROM clerk";
$stmtClerk = $conn->prepare($sqlClerk);
$stmtClerk->execute();
$regClerk = $stmtClerk->get_result();

$totalClerk = 0; // Initialize total variable

if ($regClerk->num_rows > 0) {
    while ($row = $regClerk->fetch_assoc()) {
        $totalClerk = $row['total'];
    }
}

// Fetch male and female student counts based on studIC
$sqlMale = "SELECT COUNT(*) as maleCount FROM student WHERE MOD(CAST(RIGHT(studIC, 1) AS UNSIGNED), 2) = 1";
$stmtMale = $conn->prepare($sqlMale);
$stmtMale->execute();
$resMale = $stmtMale->get_result();
$maleCount = $resMale->fetch_assoc()['maleCount'];

$sqlFemale = "SELECT COUNT(*) as femaleCount FROM student WHERE MOD(CAST(RIGHT(studIC, 1) AS UNSIGNED), 2) = 0";
$stmtFemale = $conn->prepare($sqlFemale);
$stmtFemale->execute();
$resFemale = $stmtFemale->get_result();
$femaleCount = $resFemale->fetch_assoc()['femaleCount'];

$stmtMale->close();
$stmtFemale->close();

// Fetching student counts by month
$studentCountsByMonth = array_fill(0, 12, 0); // Initialize array with 12 zeros

$sql = "
    SELECT 
        MONTH(studDOB) AS month, 
        COUNT(*) AS student_count 
    FROM 
        student 
    GROUP BY 
        MONTH(studDOB)
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $studentCountsByMonth[$row['month'] - 1] = $row['student_count']; // month is 1-12, array index is 0-11
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>