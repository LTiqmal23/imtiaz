<?php
include 'db.php';
// Check if the connection is set and not null
if (!isset($conn) || $conn === null) {
    die("Database connection not established.");
}

// Total Accepted Students
$sqlStud = "SELECT COUNT(*) as total FROM student s 
JOIN register r ON s.studID = r.studID WHERE r.registerStatus = 'ACCEPTED'";
$stmtStud = $conn->prepare($sqlStud);
$stmtStud->execute();
$resStud = $stmtStud->get_result();
$totalStud = $resStud->fetch_assoc()['total'];

// Total Registration
$sqlReg = "SELECT COUNT(*) as total FROM register";
$stmtReg = $conn->prepare($sqlReg);
$stmtReg->execute();
$resReg = $stmtReg->get_result();
$totalReg = $resReg->fetch_assoc()['total'];

// Total Clerk
$sqlClerk = "SELECT COUNT(*) as total FROM clerk";
$stmtClerk = $conn->prepare($sqlClerk);
$stmtClerk->execute();
$resClerk = $stmtClerk->get_result();
$totalClerk = $resClerk->fetch_assoc()['total'];

// Total Rejected
$sqlReject = "SELECT COUNT(registerID) as total FROM register WHERE registerStatus = 'REJECTED'";
$stmtReject = $conn->prepare($sqlReject);
$stmtReject->execute();
$resReject = $stmtReject->get_result();
$totalReject = $resReject->fetch_assoc()['total'];

// Gender Distribution
$sqlMale = "SELECT COUNT(*) as maleCount FROM student WHERE studGender = 'M'";
$stmtMale = $conn->prepare($sqlMale);
$stmtMale->execute();
$resMale = $stmtMale->get_result();
$maleCount = $resMale->fetch_assoc()['maleCount'];

$sqlFemale = "SELECT COUNT(*) as femaleCount FROM student WHERE studGender = 'F'";
$stmtFemale = $conn->prepare($sqlFemale);
$stmtFemale->execute();
$resFemale = $stmtFemale->get_result();
$femaleCount = $resFemale->fetch_assoc()['femaleCount'];

// Fetch latest 5 registrations
$sqlLatestReg = "
    SELECT r.studID, r.registerStatus 
    FROM register r 
    ORDER BY r.registerDate DESC 
    LIMIT 5";
$resLatestReg = $conn->query($sqlLatestReg);
$latestRegistrations = $resLatestReg->fetch_all(MYSQLI_ASSOC);

// Fetching student counts by state
$sqlState = "
    SELECT COUNT(r.studID) as totalStd, s.studState 
    FROM register r 
    JOIN student s ON r.studID = s.studID  
    WHERE r.registerStatus = 'ACCEPTED' 
    GROUP BY s.studState";
$resState = $conn->query($sqlState);
$totalStudentByState = $resState->fetch_all(MYSQLI_ASSOC);

// Age Distribution
$sqlAge = "
    SELECT studAge as age, COUNT(*) as count 
    FROM student 
    WHERE studAge BETWEEN 13 AND 18 
    GROUP BY studAge";
$resAge = $conn->query($sqlAge);
$ageDistribution = $resAge->fetch_all(MYSQLI_ASSOC);

// Race Distribution
$sqlRace = "
    SELECT studRace as race, COUNT(*) as count 
    FROM student 
    GROUP BY studRace";
$resRace = $conn->query($sqlRace);
$raceDistribution = $resRace->fetch_all(MYSQLI_ASSOC);

$stmtStud->close();
$stmtReg->close();
$stmtClerk->close();
$stmtReject->close();
$stmtMale->close();
$stmtFemale->close();
$conn->close();
?>
