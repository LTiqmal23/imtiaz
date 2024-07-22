<?php
$title = "Dashboard";
include 'StaffHeader.php';
include 'process/dashboard_automation.php';
?>



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
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Total Student by Month of Birth</div>
            <div class="card-body">
                <canvas id="myChart1"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Total Applicants by Gender</div>
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

    // Month labels
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Prepare data for Chart.js
    const chartData = months.map((month, index) => ({
        x: month,
        y: studentCountsByMonth[index + 1] || 0
    }));

    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Total Students',
                data: chartData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'category',
                    labels: months,
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    }
                },
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