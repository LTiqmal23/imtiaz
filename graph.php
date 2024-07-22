<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Counts by Month</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <canvas id="myChart1" width="400" height="200"></canvas>

    <script>
        <?php
        include 'process/db.php';
        // Your PHP code to fetch student counts by month
        $studentCountsByMonth = array_fill(0, 12, 0); // Initialize array with 12 zeros

        $sql = "
            SELECT 
                MONTH(studDOB) AS month, 
                COUNT(*) AS student_count 
            FROM 
                student 
            GROUP BY 
                MONTH(studDOB)
        ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $studentCountsByMonth[$row['month'] - 1] = $row['student_count']; // month is 1-12, array index is 0-11
            }
        }

        // Encode PHP array into a JavaScript array
        echo "const studentCountsByMonth = " . json_encode($studentCountsByMonth) . ";";
        ?>

        // JavaScript code to generate the chart
        const ctx = document.getElementById('myChart1').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Student Counts',
                    data: studentCountsByMonth,
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
    </script>
</body>

</html>