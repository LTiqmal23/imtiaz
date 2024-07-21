<?php
$title = "Student Management";
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
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        Register User
                    </button> -->
                    <div class="input-group" style="width: 300px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search Registration" onkeyup="searchRegistration()">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>

                <table class="table" id="studentTable">
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

                        $sql = "select * FROM register r JOIN student s ON r.studID = s.studID";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
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
                                echo "<a href='#' class='view btn btn-info' data-id='" . $row["registerID"] . "' data-name='" . $row["studName"] . "' data-date='" . $row["registerDate"] . "' data-studID='" . $row["studID"] . "'><i class='fas fa-eye'></i></a> ";
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



</main>

<script>
    let current_page = 1;
    const records_per_page = 10;
    const rows = document.querySelectorAll("#studentTable tbody tr");

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

    window.onload = function() {
        changePage(1);

        document.querySelectorAll('.view').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                // Fetch and display the student details in the view modal
                fetchStudentDetails(id, 'view');
            });
        });

        document.querySelectorAll('.edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                // Fetch and display the student details in the edit modal
                fetchStudentDetails(id, 'edit');
            });
        });

        document.querySelectorAll('.delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                // Set the student ID in the delete confirmation modal
                document.getElementById('deleteStudID').value = id;
                // Show the delete confirmation modal
                new bootstrap.Modal(document.getElementById('deleteStudentModal')).show();
            });
        });
    };

    function searchStudents() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            const studentName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (studentName.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function fetchStudentDetails(id, mode) {
        fetch(`process/get_student.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (mode === 'view') {
                    document.getElementById('viewStudID').value = data.studID;
                    document.getElementById('viewStudName').value = data.studName;
                    document.getElementById('viewStudDOB').value = data.studDOB;
                    document.getElementById('viewStudPhone').value = data.studPhone;
                    new bootstrap.Modal(document.getElementById('viewStudentModal')).show();
                } else if (mode === 'edit') {
                    document.getElementById('editStudID').value = data.studID;
                    document.getElementById('editStudName').value = data.studName;
                    document.getElementById('editStudDOB').value = data.studDOB;
                    document.getElementById('editStudPhone').value = data.studPhone;
                    new bootstrap.Modal(document.getElementById('editStudentModal')).show();
                }
            })
            .catch(error => console.error('Error:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.view');
        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var registerID = this.getAttribute('data-id');
                var studName = this.getAttribute('data-name');
                var registerDate = this.getAttribute('data-date');
                var studID = this.getAttribute('data-studID');

                document.getElementById('modal-registerID').textContent = registerID;
                document.getElementById('modal-registerDate').textContent = registerDate;
                document.getElementById('modal-studName').textContent = studName;
                document.getElementById('modal-studID').textContent = studID;

                var modal = new bootstrap.Modal(document.getElementById('viewModal'));
                modal.show();
            });
        });
    });
</script>
</body>

</html>