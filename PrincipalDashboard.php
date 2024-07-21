<?php
$title = "Dashboard";
include 'PrincipalHeader.php';
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



<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Total Students</div>
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
            <div class="card-header">Fees Collection</div>
            <div class="card-body">
                <h5 class="card-title">$13,921</h5>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Total Student by Month</div>
            <div class="card-body">
                <canvas id="myChart1"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Total Student by Gender</div>
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

    // Total Student by Month Line Chart
    var studentCountsByMonth = <?php echo json_encode($studentCountsByMonth); ?>;
    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var myChart1 = new Chart(ctx1, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Total Students',
                data: studentCountsByMonth,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10 // Adjust the step size as needed
                    }
                }
            }
        }
    });
</script>
</body>

</html>