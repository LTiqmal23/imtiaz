<!DOCTYPE html>
<?php
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