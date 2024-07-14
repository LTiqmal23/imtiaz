<?php include 'StudentHeader.php'; ?>
<?php
include 'process/db.php';
$studID = $_SESSION['studID'];

// Prepare the SQL statement
$sql = "SELECT * FROM student WHERE studID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studID);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['studName'];
        $address = $row['studAddress'];
        $phone = $row['studPhone'];
        $DOB = $row['studDOB'];
        $race = $row['studRace'];
    }
}

$stmt->close();
$conn->close();
?>

<main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profile</h1>
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

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">Student Profile</div>
                <div class="card-body">
                    <h4>Student Profile</h4>
                    <p>Here you can view your profile and other information</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3 ">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <img src="student.png" alt="Profile Picture" class="profile-img">
                                    <h4 class="mt-3"><?php echo $name; ?></h4>
                                    <p>hafizah@student.uitm.edu.my</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePictureModal">Change Picture</button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-header">Personal Information</div>
                                <div class="card-body student-info">
                                    <p><strong>Name:</strong> <?php echo $name; ?></p>
                                    <p><strong>Matric Number:</strong> <?php echo $studID; ?></p>
                                    <p><strong>Date of Birth:</strong> <?php echo $DOB; ?></p>
                                    <p><strong>Race:</strong> <?php echo $race; ?></p>
                                    <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>
                                    <p><strong>Address:</strong> <?php echo $address; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Picture Modal -->
    <div class="modal fade" id="changePictureModal" tabindex="-1" aria-labelledby="changePictureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePictureModalLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="profilePicture" class="form-label">Upload New Profile Picture</label>
                            <input class="form-control" type="file" id="profilePicture">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="process/studEditProfile.php" method="POST">
                    <input type="hidden" name="studID" value="<?php echo $studID; ?>">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="studName" value="<?php echo $name; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editDOB" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="editDOB" name="studDOB" value="<?php echo $DOB; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editRace" class="form-label">Race</label>
                        <input type="text" class="form-control" id="editRace" name="studRace" value="<?php echo $race; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="editPhone" name="studPhone" value="<?php echo $phone; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="studAddress" value="<?php echo $address; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-rgkE5xAHTABUgN6D+PHV3Jj6qK6wMGFt3URZ5+E1HgNVQz+P5icHYX5rVoQxk2D9" crossorigin="anonymous"></script>
</body>
</html>
