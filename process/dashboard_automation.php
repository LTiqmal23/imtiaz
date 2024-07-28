<!DOCTYPE html>
<?php
include 'db.php';
// Check if the connection is set and not null
if (!isset($conn) || $conn === null) {
    die("Database connection not established.");
}

// Total Student
$sqlStud = "select COUNT(*) as total FROM student s 
JOIN register r ON s.studID = r.studID where r.registerStatus = 'ACCEPTED'";
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

// Total Rejected 
$sqlReject = "select COUNT(registerID) as total FROM register where registerStatus = 'REJECTED'";
$stmtReject = $conn->prepare($sqlReject);
$stmtReject->execute();
$regReject = $stmtReject->get_result();

$totalReject = 0; // Initialize total variable

if ($regReject->num_rows > 0) {
    while ($row = $regReject->fetch_assoc()) {
        $totalReject = $row['total'];
    }
}

// Fetch male and female student counts based on studIC
$sqlMale = "SELECT COUNT(*) as maleCount FROM student WHERE studGender ='M'";
$stmtMale = $conn->prepare($sqlMale);
$stmtMale->execute();
$resMale = $stmtMale->get_result();
$maleCount = $resMale->fetch_assoc()['maleCount'];

$sqlFemale = "SELECT COUNT(*) as femaleCount FROM student WHERE studGender ='F'";
$stmtFemale = $conn->prepare($sqlFemale);
$stmtFemale->execute();
$resFemale = $stmtFemale->get_result();
$femaleCount = $resFemale->fetch_assoc()['femaleCount'];

$stmtMale->close();
$stmtFemale->close();

// Fetching student counts by state
$totalStudentByState = array();

$sql = "
    SELECT COUNT(R.studID) as totalStd, S.studState 
    FROM register R join Student S
    ON R.studID = S.studID  
    WHERE registerStatus = 'ACCEPTED' 
    GROUP BY studState
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalStudentByState[] = array('state' => $row['studState'], 'total' => $row['totalStd']);
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph</title>
</head>

<body>

</body>

</html>