<?php
$title = "Profile";
include 'StudentHeader.php'; ?>
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
        $email = $row['studEmail'];
        $address = $row['studAddress'];
        $phone = $row['studPhone'];
        $DOB = $row['studDOB'];
        $race = $row['studRace'];
    }
}

$stmt->close();
$conn->close();
?>



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
                                <p><?php echo $email; ?></p>
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
                <form id="editProfileForm" action="process/studEditProfile.php" method="POST">
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
<script>
    document.getElementById('editProfileForm').addEventListener('submit', function(event) {
        // Get form elements
        const name = document.getElementById('editName').value.trim();
        const dob = document.getElementById('editDOB').value.trim();
        const race = document.getElementById('editRace').value.trim();
        const phone = document.getElementById('editPhone').value.trim();
        const address = document.getElementById('editAddress').value.trim();

        // Validate name
        const letterPattern = /^[A-Za-z\s]+$/;
        if (!letterPattern.test(name)) {
            alert("Name must contain only letters and spaces.");
            event.preventDefault();
            return;
        }

        // Validate date of birth
        if (dob === "") {
            alert("Date of Birth is required.");
            event.preventDefault();
            return;
        }

        // Validate race
        if (race === "") {
            alert("Race is required.");
            event.preventDefault();
            return;
        }

        if (!letterPattern.test(race)) {
            alert("Race must contain only letters and spaces.");
            event.preventDefault();
            return;
        }

        // Validate phone number
        const phonePattern = /^\d{10,15}$/;
        if (!phonePattern.test(phone)) {
            alert("Phone number must be between 10 and 15 digits.");
            event.preventDefault();
            return;
        }

        // Validate address
        if (address === "") {
            alert("Address is required.");
            event.preventDefault();
            return;
        }
    });
</script>


</body>

</html>