<?php
include 'process/db.php';

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
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>
