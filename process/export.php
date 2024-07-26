<?php
// Include database connection
include 'db.php';

if (isset($_POST['export'])) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="StudentRegistrations.xls"');

    $sql = "SELECT * FROM register r JOIN student s ON r.studID = s.studID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table border="1">';
        echo '<tr>
                <th>Register ID</th>
                <th>Registration Date</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Status</th>
              </tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row["registerID"] . '</td>
                    <td>' . $row["registerDate"] . '</td>
                    <td>' . $row["studID"] . '</td>
                    <td>' . $row["studName"] . '</td>
                    <td>' . $row["registerStatus"] . '</td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo 'No data available';
    }

    $conn->close();
    exit();
}
?>
