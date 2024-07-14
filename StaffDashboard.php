<?php
include 'StaffHeader.php';
include 'process/dashboard_automation.php';
// Check if the connection is set and not null
if (!isset($conn) || $conn === null) {
    die("Database connection not established.");
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
$conn->close();
?>

<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Students</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalStud; ?></h5>
                    <div class="progress mb-1" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                        <div class="progress-bar" style="width: 45%"></div>
                    </div>
                    <p class="card-text">45% Increase in 28 Days</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Registration</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalReg; ?></h5>
                    <div class="progress mb-1" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                        <div class="progress-bar" style="width: 40%"></div>
                    </div>
                    <p class="card-text">40% Increase in 28 Days</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Clerk</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalClerk; ?></h5>
                    <div class="progress mb-1" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                        <div class="progress-bar" style="width: 85%"></div>
                    </div>
                    <p class="card-text">85% Increase in 28 Days</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Fees Collection</div>
                <div class="card-body">
                    <h5 class="card-title">$13,921</h5>
                    <div class="progress mb-1" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <p class="card-text">50% Increase in 28 Days</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">School Income</div>
                <div class="card-body">
                    <canvas id="myChart1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">School Survey</div>
                <div class="card-body">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        // Income Line Chart
        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Income',
                    data: [19, 15, 22, 25, 31, 19, 31],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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

        // Gender Distribution Bar Chart
        var maleCount = <?php echo $maleCount; ?>;
        var femaleCount = <?php echo $femaleCount; ?>;
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
    </script>
</body>

</html>