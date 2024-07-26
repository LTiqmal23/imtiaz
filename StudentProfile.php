<?php
$title = "Profile";
include 'StudentHeader.php';
include 'process/db.php';

$studID = $_SESSION['studID'];

// Prepare the SQL statement
$sql = "select * FROM student WHERE studID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['studName'];
        $ic = $row['studIC'];
        $email = $row['studEmail'];
        $gender = $row['studGender'];
        $state = $row['studState'];
        $district = $row['studDistrict'];
        $poscode = $row['studPoscode'];
        $address = $row['studAddress'];
        $phone = $row['studPhone'];
        $DOB = $row['studDOB'];
        $race = $row['studRace'];
        $gender = $row['stuGender'];
        $age = $row['stuAge'];
        $postcode = $row['studPostcode'];
        $city = $row['studCity'];
        $parentName = $row['studParentName'];
        $parentNo = $row['studParentNo'];
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
                        <div class="card mb-3">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <img src="student.png" alt="Profile Picture" class="profile-img">
                                <h4 class="mt-3"><?php echo $name; ?></h4>
                                <p><?php echo $email; ?></p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePictureModal">Change Picture</button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal1">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header">Personal Information</div>
                            <div class="card-body student-info">
                                <p><strong>Name:</strong> <?php echo $name; ?></p>
                                <p><strong>Matric Number:</strong> <?php echo $studID; ?></p>
                                <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                                <p><strong>Date of Birth:</strong> <?php echo $DOB; ?></p>
                                <p><strong>Race:</strong> <?php echo $race; ?></p>
                                <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>
                                <p><strong>State:</strong> <?php echo $state; ?></p>
                                <p><strong>District:</strong> <?php echo $district; ?></p>
                                <p><strong>Poscode:</strong> <?php echo $poscode; ?></p>
                                <p><strong>Address:</strong> <?php echo $address; ?></p>
                                <p><strong>Email:</strong> <?php echo $email; ?></p>
                                <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                                <p><strong>Age:</strong> <?php echo $age; ?></p>
                                <p><strong>Postcode:</strong> <?php echo $postcode; ?></p>
                                <p><strong>City:</strong> <?php echo $city; ?></p>
                                <p><strong>Parent Name:</strong> <?php echo $parentName; ?></p>
                                <p><strong>Parent Number:</strong> <?php echo $parentNo; ?></p>
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

<!-- Edit Profile Modal Part 1 -->
<div class="modal fade" id="editProfileModal1" tabindex="-1" aria-labelledby="editProfileModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel1">Edit Profile - Part 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm1">
                    <input type="hidden" name="studID" value="<?php echo $studID; ?>">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="studName" value="<?php echo $name; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editIC" class="form-label">IC</label>
                        <input type="text" class="form-control" id="editIC" name="studIC" value="<?php echo $ic; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editDOB" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="editDOB" name="studDOB" value="<?php echo $DOB; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="editPhone" name="studPhone" value="<?php echo $phone; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editRace" class="form-label">Race</label>
                        <input type="text" class="form-control" id="editRace" name="studRace" value="<?php echo $race; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="studEmail" value="<?php echo $email; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editPassword" name="studPassword" value="">
                    </div>
                    <button type="button" class="btn btn-primary" id="nextModalButton">Next</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal Part 2 -->
<div class="modal fade" id="editProfileModal2" tabindex="-1" aria-labelledby="editProfileModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel2">Edit Profile - Part 2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm2" action="process/studEditProfile.php" method="POST">
                    <input type="hidden" name="studID" value="<?php echo $studID; ?>">
                    <div class="mb-3">
                        <label for="editGender" class="form-label">Gender</label>
                        <select class="form-control" id="editGender" name="stuGender">
                            <option value="M" <?php echo $gender == 'M' ? 'selected' : ''; ?>>Male</option>
                            <option value="F" <?php echo $gender == 'F' ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editAge" class="form-label">Age</label>
                        <input type="number" class="form-control" id="editAge" name="stuAge" value="<?php echo $age; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editPostcode" class="form-label">Postcode</label>
                        <input type="text" class="form-control" id="editPostcode" name="studPostcode" value="<?php echo $postcode; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editCity" class="form-label">City</label>
                        <select class="form-control" id="editCity" name="studCity">
                            <option value="Johor" <?php echo $city == 'Johor' ? 'selected' : ''; ?>>Johor</option>
                            <option value="Kedah" <?php echo $city == 'Kedah' ? 'selected' : ''; ?>>Kedah</option>
                            <option value="Kelantan" <?php echo $city == 'Kelantan' ? 'selected' : ''; ?>>Kelantan</option>
                            <option value="Melaka" <?php echo $city == 'Melaka' ? 'selected' : ''; ?>>Melaka</option>
                            <option value="Negeri Sembilan" <?php echo $city == 'Negeri Sembilan' ? 'selected' : ''; ?>>Negeri Sembilan</option>
                            <option value="Pahang" <?php echo $city == 'Pahang' ? 'selected' : ''; ?>>Pahang</option>
                            <option value="Penang" <?php echo $city == 'Penang' ? 'selected' : ''; ?>>Penang</option>
                            <option value="Perak" <?php echo $city == 'Perak' ? 'selected' : ''; ?>>Perak</option>
                            <option value="Perlis" <?php echo $city == 'Perlis' ? 'selected' : ''; ?>>Perlis</option>
                            <option value="Sabah" <?php echo $city == 'Sabah' ? 'selected' : ''; ?>>Sabah</option>
                            <option value="Sarawak" <?php echo $city == 'Sarawak' ? 'selected' : ''; ?>>Sarawak</option>
                            <option value="Selangor" <?php echo $city == 'Selangor' ? 'selected' : ''; ?>>Selangor</option>
                            <option value="Terengganu" <?php echo $city == 'Terengganu' ? 'selected' : ''; ?>>Terengganu</option>
                            <option value="Kuala Lumpur" <?php echo $city == 'Kuala Lumpur' ? 'selected' : ''; ?>>Kuala Lumpur</option>
                            <option value="Labuan" <?php echo $city == 'Labuan' ? 'selected' : ''; ?>>Labuan</option>
                            <option value="Putrajaya" <?php echo $city == 'Putrajaya' ? 'selected' : ''; ?>>Putrajaya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="studAddress" value="<?php echo $address; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editParentName" class="form-label">Parent Name</label>
                        <input type="text" class="form-control" id="editParentName" name="studParentName" value="<?php echo $parentName; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editParentNo" class="form-label">Parent Number</label>
                        <input type="text" class="form-control" id="editParentNo" name="studParentNo" value="<?php echo $parentNo; ?>">
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
    document.getElementById('nextModalButton').addEventListener('click', function() {
    // Close the first modal
    var modal1 = new bootstrap.Modal(document.getElementById('editProfileModal1'));
    modal1.hide();
    
    // Open the second modal
    var modal2 = new bootstrap.Modal(document.getElementById('editProfileModal2'));
    modal2.show();
});

// Combine form data and submit
document.getElementById('editProfileForm2').addEventListener('submit', function(event) {
    event.preventDefault();

    // Collect data from the first form
    const form1 = document.getElementById('editProfileForm1');
    const formData1 = new FormData(form1);

    // Collect data from the second form
    const form2 = document.getElementById('editProfileForm2');
    const formData2 = new FormData(form2);

    // Combine data
    for (let [key, value] of formData2.entries()) {
        formData1.append(key, value);
    }

    // Submit combined data using fetch API
    fetch('process/studEditProfile.php', {
        method: 'POST',
        body: formData1
    }).then(response => response.text())
      .then(data => {
          console.log(data);
          window.location.href = '../studentProfile.php';
      }).catch(error => console.error('Error:', error));
});

</script>

</body>
</html>
