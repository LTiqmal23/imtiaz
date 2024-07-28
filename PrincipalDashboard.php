<?php
$title = "Dashboard";
include 'PrincipalHeader.php';
include 'process/dashboard_automation.php';
// Check if the connection is set and not null
if (!isset($conn) || $conn === null) {
    die("Database connection not established.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Accepted Students</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalStud; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Registration</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalReg; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Clerk</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalClerk; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Rejected Application</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalReject; ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Total Students by State</div>
                <div class="card-body">
                    <canvas id="myChart1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Latest 5 Registrations</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($latestRegistrations as $registration) : ?>
                            <tr>
                                <td><?php echo $registration['studID']; ?></td>
                                <td><?php echo $registration['registerStatus']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Total Applicants by Gender</div>
                <div class="card-body">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Total Students by Age</div>
                <div class="card-body">
                    <canvas id="myChart3"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Total Students by Race</div>
                <div class="card-body">
                    <canvas id="myChart4"></canvas>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Gender Distribution Bar Chart
        var maleCount = <?php echo json_encode($maleCount); ?>;
        var femaleCount = <?php echo json_encode($femaleCount); ?>;
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Student Count',
                    data: [maleCount, femaleCount],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 2, // Adjust the step size as needed
                        }
                    }
                }
            }
        });

        // Students by State Bar Chart
        var totalStudentByState = <?php echo json_encode($totalStudentByState); ?>;
        var states = totalStudentByState.map(function(item) {
            return item.studState;
        });
        var totalStudents = totalStudentByState.map(function(item) {
            return item.totalStd;
        });
        var ctx = document.getElementById('myChart1').getContext('2d');
        var myChart1 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: states,
                datasets: [{
                    label: 'Total Students',
                    data: totalStudents,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Age Distribution Bar Chart
        var ageDistribution = <?php echo json_encode($ageDistribution); ?>;
        var ages = ageDistribution.map(function(item) {
            return item.age;
        });
        var ageCounts = ageDistribution.map(function(item) {
            return item.count;
        });
        var ctx3 = document.getElementById('myChart3').getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ages,
                datasets: [{
                    label: 'Total Students',
                    data: ageCounts,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Race Distribution Pie Chart
        var raceDistribution = <?php echo json_encode($raceDistribution); ?>;
        var races = raceDistribution.map(function(item) {
            return item.race;
        });
        var raceCounts = raceDistribution.map(function(item) {
            return item.count;
        });
        var ctx4 = document.getElementById('myChart4').getContext('2d');
        var myChart4 = new Chart(ctx4, {
            type: 'pie',
            data: {
                labels: races,
                datasets: [{
                    label: 'Total Students',
                    data: raceCounts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    });
</script>
</body>
</html>
