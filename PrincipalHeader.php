<?php
session_start();
$principalD = $_SESSION['principalID'];
$principalName = $_SESSION['principalName'];
include 'process/db.php';
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

    <script>
        function printPage() {
            window.print();
        }
    </script>
    <div class="container-fluid">
        <div class="row">
            <nav class="sidebar col-md-2 d-none d-md-block">
                <div class="logo mb-5">
                    <h4><i class="fas fa-user-graduate me-3"></i>Imtiaz Besut</h4>
                </div>
                <div class="profile mb-3 ">
                    <img src="staff.png" alt="">
                    <div class="profile-info ms-2">
                        <h4><?php echo $principalName; ?></h4>
                        <p>Principal</p>
                    </div>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="PrincipalDashboard.php" class="nav-link"><i class="fas fa-home"></i>Home</a></li>
                    <li class="nav-item"><a href="PrincipalStudent.php" class="nav-link"><i class="fas fa-user-graduate"></i>Students</a></li>
                    <li class="nav-item"><a href="PrincipalClerk.php" class="nav-link"><i class="fas fa-chalkboard-teacher"></i>Clerk</a></li>

                    <li class="nav-item logout"><a href="MainLogout.php" class="nav-link"><i class="fas fa-power-off"></i>Logout</a></li>
                </ul>
            </nav>
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?php echo $title ?></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printPage()">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            This week
                        </button>
                    </div>
                </div> 