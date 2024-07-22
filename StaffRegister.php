<?php
$title = "Student Management";
$tableid = "registerTable";
include 'StaffHeader.php';

if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message_type'] . ' alert-dismissible fade show" role="alert">'
        . $_SESSION['message'] .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">User Registration</div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div class="input-group" style="width: 300px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search Registration" onkeyup="searchRegistration()">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <div class="input-group" style="width: 200px;">
                        <select id="statusFilter" class="form-select" onchange="filterStatus()">
                            <option value="">All Statuses</option>
                            <option value="PENDING">Pending</option>
                            <option value="ACCEPTED">Accepted</option>
                            <option value="REJECTED">Rejected</option>
                        </select>
                    </div>
                </div>

                <table class="table" id="registerTable">
                    <thead>
                        <tr>
                            <th>Register ID</th>
                            <th>Registration Date</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'process/db.php';

                        $sql = "SELECT * FROM register r JOIN student s ON r.studID = s.studID";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr data-status='" . $row["registerStatus"] . "'>";
                                echo "<td>" . $row["registerID"] . "</td>";
                                echo "<td>" . $row["registerDate"] . "</td>";
                                echo "<td>" . $row["studID"] . "</td>";
                                echo "<td>" . $row["studName"] . "</td>";
                                if ($row["registerStatus"] == 'PENDING') {
                                    echo "<td><span class='badge bg-warning'>" . $row["registerStatus"] . "</span></td>";
                                } else if ($row["registerStatus"] == 'ACCEPTED') {
                                    echo "<td><span class='badge bg-success'>" . $row["registerStatus"] . "</span></td>";
                                } else if ($row["registerStatus"] == 'REJECTED') {
                                    echo "<td><span class='badge bg-danger'>" . $row["registerStatus"] . "</span></td>";
                                }

                                echo "<td>";
                                echo "<a href='#' class='view' data-id='" . $row["registerID"] . "' data-name='" . $row["studName"] . "' data-date='" . $row["registerDate"] . "' data-studID='" . $row["studID"] . "'><i class='fas fa-eye'></i></a> ";
                                if ($row["registerStatus"] == 'PENDING') {
                                    echo "<a href='process/registerAccept.php?acceptID=" . $row["registerID"] . "' class='btn btn-primary'>Accept</a> ";
                                    echo "<a href='process/registerReject.php?rejectID=" . $row["registerID"] . "' class='btn btn-danger'>Reject</a>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No results</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center" id="pagination"></ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Register ID:</strong> <span id="modal-registerID"></span></p>
                <p><strong>Register Date:</strong> <span id="modal-registerDate"></span></p>
                <p><strong>Student ID:</strong> <span id="modal-studID"></span></p>
                <p><strong>Student Name:</strong> <span id="modal-studName"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    let current_page = 1;
    const records_per_page = 10;
    const rows = document.querySelectorAll("#registerTable tbody tr");

    function changePage(page) {
        const pagination = document.getElementById("pagination");
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        pagination.innerHTML = "";

        for (let i = 0; i < rows.length; i++) {
            rows[i].style.display = "none";
        }

        for (let i = (page - 1) * records_per_page; i < (page * records_per_page) && i < rows.length; i++) {
            rows[i].style.display = "";
        }

        if (page === 1) {
            pagination.innerHTML += '<li class="page-item disabled"><a class="page-link" href="javascript:prevPage();">Previous</a></li>';
        } else {
            pagination.innerHTML += '<li class="page-item"><a class="page-link" href="javascript:prevPage();">Previous</a></li>';
        }

        for (let i = 1; i <= numPages(); i++) {
            if (i === page) {
                pagination.innerHTML += '<li class="page-item active"><a class="page-link" href="javascript:changePage(' + i + ');">' + i + '</a></li>';
            } else {
                pagination.innerHTML += '<li class="page-item"><a class="page-link" href="javascript:changePage(' + i + ');">' + i + '</a></li>';
            }
        }

        if (page === numPages()) {
            pagination.innerHTML += '<li class="page-item disabled"><a class="page-link" href="javascript:nextPage();">Next</a></li>';
        } else {
            pagination.innerHTML += '<li class="page-item"><a class="page-link" href="javascript:nextPage();">Next</a></li>';
        }
    }

    function numPages() {
        return Math.ceil(rows.length / records_per_page);
    }

    function prevPage() {
        if (current_page > 1) {
            current_page--;
            changePage(current_page);
        }
    }

    function nextPage() {
        if (current_page < numPages()) {
            current_page++;
            changePage(current_page);
        }
    }

    function searchRegistration() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#registerTable tbody tr');

        rows.forEach(row => {
            const studentName = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            if (studentName.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function filterStatus() {
        const filter = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('#registerTable tbody tr');

        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            if (filter === "" || status === filter) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        changePage(1);

        document.querySelectorAll('.view').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const date = this.getAttribute('data-date');
                const studID = this.getAttribute('data-studID');

                document.getElementById('modal-registerID').textContent = id;
                document.getElementById('modal-registerDate').textContent = date;
                document.getElementById('modal-studName').textContent = name;
                document.getElementById('modal-studID').textContent = studID;

                const modal = new bootstrap.Modal(document.getElementById('viewModal'));
                modal.show();
            });
        });
    });
</script>
</body>

</html>