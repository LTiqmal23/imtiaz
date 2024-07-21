<?php
$title = "Student Management";
include 'PrincipalHeader.php';
?>


<?php
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
            <div class="card-header">Imtiaz Student</div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        Add Student
                    </button>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search Student" onkeyup="searchStudents()">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>

                <table class="table" id="studentTable">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>DOB</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'process/db.php';
                        $sql = "SELECT * FROM student";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["studID"] . "</td><td>" . $row["studName"] . "</td><td>" . $row["studDOB"] . "</td><td>" . $row["studPhone"] . "</td><td>
                                    <a href='#' class='view' data-id='" . $row["studID"] . "'><i class='fas fa-eye'></i></a>
                                    </td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No results</td></tr>";
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

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_student.php" method="POST">
                    <div class="mb-3">
                        <label for="studID" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="studID" name="studID" required>
                    </div>
                    <div class="mb-3">
                        <label for="studName" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="studName" name="studName" required>
                    </div>
                    <div class="mb-3">
                        <label for="studDOB" class="form-label">DOB</label>
                        <input type="date" class="form-control" id="studDOB" name="studDOB" required>
                    </div>
                    <div class="mb-3">
                        <label for="studPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="studPhone" name="studPhone" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStudentModalLabel">View Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="viewStudID" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="viewStudID" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewStudName" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="viewStudName" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewStudDOB" class="form-label">DOB</label>
                        <input type="date" class="form-control" id="viewStudDOB" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewStudPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="viewStudPhone" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="process/edit_student.php" method="POST">
                    <div class="mb-3">
                        <label for="editStudID" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="editStudID" name="studID" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStudName" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="editStudName" name="studName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStudDOB" class="form-label">DOB</label>
                        <input type="date" class="form-control" id="editStudDOB" name="studDOB" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStudPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="editStudPhone" name="studPhone" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Student Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStudentModalLabel">Delete Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this student?</p>
                <form action="process/delete_student.php" method="POST">
                    <input type="hidden" id="deleteStudID" name="studID">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
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
</script>
</body>

</html>