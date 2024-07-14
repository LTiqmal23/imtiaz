<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Website Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>


    <div class="container-fluid">
        <div class="row">
            <nav class="sidebar col-md-2 d-none d-md-block">
                <div class="logo mb-5">
                    <h4><i class="fas fa-user-graduate me-3"></i>Imtiaz Besut</h4>
                </div>
                <div class="profile mb-3 ">
                    <img src="staff.png" alt="">
                    <div class="profile-info ms-2">
                        <h4>Hafizah</h4>
                        <p>Staff</p>
                    </div>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="StaffDashboard.php" class="nav-link"><i class="fas fa-home"></i>Home</a></li>
                    <li class="nav-item"><a href="StaffStudent.php" class="nav-link"><i class="fas fa-user-graduate"></i>Students</a></li>
                    <li class="nav-item"><a href="StaffStaff.php" class="nav-link"><i class="fas fa-chalkboard-teacher"></i>Staff</a></li>
                    <li class="nav-item"><a href="StaffReport.php" class="nav-link"><i class="fas fa-file-alt"></i>Reports</a></li>
                    <li class="nav-item logout"><a href="MainLogout.php" class="nav-link"><i class="fas fa-power-off"></i>Logout</a></li>
                </ul>
            </nav>
   