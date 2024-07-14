<?php include 'StaffHeader.php'; ?>

<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Student Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>
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
                <div class="card-header">Imtiaz Clerk</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClerkModal">
                            Add Clerk
                        </button>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search Clerk" onkeyup="searchClerks()">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>

                    <table class="table" id="clerkTable">
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'process/db.php';
                            $sql = "SELECT * FROM clerk";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row["clerkID"] . "</td><td>" . $row["clerkName"] . "</td><td>" . $row["clerkPhone"] . "</td><td>
                                    <a href='#' class='view ' data-id='" . $row["clerkID"] . "'><i class='fas fa-eye'></i></a>
                                    <a href='#' class='edit ms-2' data-id='" . $row["clerkID"] . "'><i class='fas fa-edit'></i></a>
                                    <a href='#' class='delete ms-2' data-id='" . $row["clerkID"] . "'><i class='fas fa-trash'></i></a>
                                    </td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No results</td></tr>";
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

    <!-- Add Clerk Modal -->
    <div class="modal fade" id="addClerkModal" tabindex="-1" aria-labelledby="addClerkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClerkModalLabel">Add Clerk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="process/add_clerk.php" method="POST">
                        <div class="mb-3">
                            <label for="clerkID" class="form-label">Staff ID</label>
                            <input type="text" class="form-control" id="clerkID" name="clerkID" required>
                        </div>
                        <div class="mb-3">
                            <label for="clerkName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="clerkName" name="clerkName" required>
                        </div>
                        <div class="mb-3">
                            <label for="clerkPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="clerkPhone" name="clerkPhone" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Clerk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Clerk Modal -->
    <div class="modal fade" id="viewClerkModal" tabindex="-1" aria-labelledby="viewClerkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewClerkModalLabel">View Clerk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="viewClerkID" class="form-label">Staff ID</label>
                            <input type="text" class="form-control" id="viewClerkID" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="viewClerkName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="viewClerkName" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="viewClerkPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="viewClerkPhone" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Clerk Modal -->
    <div class="modal fade" id="editClerkModal" tabindex="-1" aria-labelledby="editClerkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClerkModalLabel">Edit Clerk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="process/edit_clerk.php" method="POST">
                        <div class="mb-3">
                            <label for="editClerkID" class="form-label">Staff ID</label>
                            <input type="text" class="form-control" id="editClerkID" name="clerkID" required>
                        </div>
                        <div class="mb-3">
                            <label for="editClerkName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="editClerkName" name="clerkName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editClerkPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="editClerkPhone" name="clerkPhone" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Clerk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Clerk Modal -->
    <div class="modal fade" id="deleteClerkModal" tabindex="-1" aria-labelledby="deleteClerkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteClerkModalLabel">Delete Clerk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this clerk?</p>
                    <form action="process/delete_clerk.php" method="POST">
                        <input type="hidden" id="deleteClerkID" name="clerkID">
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
    const rows = document.querySelectorAll("#clerkTable tbody tr");

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
                // Fetch and display the clerk details in the view modal
                fetchClerkDetails(id, 'view');
            });
        });

        document.querySelectorAll('.edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                // Fetch and display the clerk details in the edit modal
                fetchClerkDetails(id, 'edit');
            });
        });

        document.querySelectorAll('.delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                // Set the clerk ID in the delete confirmation modal
                document.getElementById('deleteClerkID').value = id;
                // Show the delete confirmation modal
                new bootstrap.Modal(document.getElementById('deleteClerkModal')).show();
            });
        });
    };

    function searchClerks() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            const clerkName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (clerkName.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function fetchClerkDetails(id, mode) {
        fetch(`process/get_clerk.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (mode === 'view') {
                    document.getElementById('viewClerkID').value = data.clerkID;
                    document.getElementById('viewClerkName').value = data.clerkName;
                    document.getElementById('viewClerkPhone').value = data.clerkPhone;
                    new bootstrap.Modal(document.getElementById('viewClerkModal')).show();
                } else if (mode === 'edit') {
                    document.getElementById('editClerkID').value = data.clerkID;
                    document.getElementById('editClerkName').value = data.clerkName;
                    document.getElementById('editClerkPhone').value = data.clerkPhone;
                    new bootstrap.Modal(document.getElementById('editClerkModal')).show();
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>
