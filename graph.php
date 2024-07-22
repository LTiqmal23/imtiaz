<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Counts by Month</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <canvas id="myChart1" width="800" height="400"></canvas>

    <script>
        <?php
        include 'process/db.php';
        // Your PHP code to fetch student counts by month
        $studentCountsByMonth = array();

        $sql = "
            SELECT 
                MONTH(studDOB) AS month, 
                COUNT(*) AS student_count 
            FROM 
                student 
            GROUP BY 
                MONTH(studDOB)
            ORDER BY 
                MONTH(studDOB)
        ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $studentCountsByMonth[$row['month']] = $row['student_count'];
            }
        }

        // Encode PHP array into a JavaScript object
        echo "const studentCountsByMonth = " . json_encode($studentCountsByMonth) . ";";
        ?>

        // JavaScript code to generate the chart
        const ctx = document.getElementById('myChart1').getContext('2d');

        // Month labels
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Prepare data for Chart.js
        const chartData = months.map((month, index) => ({
            x: month,
            y: studentCountsByMonth[index + 1] || 0
        }));

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Student Counts',
                    data: chartData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>