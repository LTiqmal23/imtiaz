<?php
session_start();
$clerkID = $_SESSION['clerkID'];
$clerkName = $_SESSION['clerkName'];
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <script>
        function printPage() {
            window.print();
        }

       
        function printPage() {
            window.print();
        }

        function exportTableToExcel(tableID, filename = '') {
            var tableSelect = document.getElementById(tableID);
            var workbook = XLSX.utils.table_to_book(tableSelect, { sheet: "Sheet1" });

            // Apply formatting to the cells
            var ws = workbook.Sheets["Sheet1"];

            // Define the formatting
            var fmt_date = "yyyy-mm-dd";
            var fmt_number = "0";
            var fmt_text = "@";

            // Apply formatting to specific columns
            for (var cell in ws) {
                if (cell[0] === '!') continue; // skip non-data cells

                if (cell.match(/A\d+/)) { // Column A - ID, Number format
                    ws[cell].z = fmt_text;
                } else if (cell.match(/B\d+/)) { // Column B - Name, Text format
                    ws[cell].z = fmt_text;
                } else if (cell.match(/C\d+/)) { // Column C - DOB, Date format
                    ws[cell].z = fmt_text;
                } else if (cell.match(/D\d+/)) { // Column D - Phone, Text format
                    ws[cell].z = fmt_text;
                }
            }

            var wbout = XLSX.write(workbook, { bookType: 'xlsx', type: 'binary' });

            function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                return buf;
            }

            var blob = new Blob([s2ab(wbout)], { type: "application/octet-stream" });

            if (navigator.msSaveOrOpenBlob) {
                navigator.msSaveOrOpenBlob(blob, filename + ".xlsx");
            } else {
                var link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = filename + ".xlsx";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
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
                        <h4><?php echo $clerkName; ?></h4>
                        <p>Clerk</p>
                    </div>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="StaffDashboard.php" class="nav-link"><i class="fas fa-home"></i>Home</a></li>
                    <li class="nav-item"><a href="StaffRegister.php" class="nav-link"><i class="fas fa-plus-square"></i>Register</a></li>
                    <li class="nav-item"><a href="StaffStudent.php" class="nav-link"><i class="fas fa-user-graduate"></i>Students</a></li>
                    <li class="nav-item"><a href="StaffStaff.php" class="nav-link"><i class="fas fa-chalkboard-teacher"></i>Staff</a></li>

                    <li class="nav-item logout"><a href="MainLogout.php" class="nav-link"><i class="fas fa-power-off"></i>Logout</a></li>
                </ul>
            </nav>
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?php echo $title ?></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printPage()">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportTableToExcel('<?php echo $tableid ?>', '<?php echo $tableid ?>')">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            This week
                        </button>
                    </div>
                </div>