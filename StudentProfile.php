<?php
$title = "Profile";
include 'StudentHeader.php';
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
        $ic = $row['studIC'];
        $email = $row['studEmail'];
        $address = $row['studAddress'];
        $phone = $row['studPhone'];
        $DOB = $row['studDOB'];
        $race = $row['studRace'];
        $gender = $row['studGender'];
        $age = $row['studAge'];
        $postcode = $row['studPostcode'];
        $state = $row['studState'];
        $district = $row['studDistrict'];
        $parentName = $row['studParentName'];
        $parentNo = $row['studParentNo'];
    }
}

$stmt->close();
$conn->close();

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
                                <p><strong>Age:</strong> <?php echo $age; ?></p>
                                <p><strong>Race:</strong> <?php echo $race; ?></p>
                                <p><strong>Gender:</strong> <?php echo $gender == 'M' ? 'Male' : 'Female'; ?></p>
                                <p><strong>Postcode:</strong> <?php echo $postcode; ?></p>
                                <p><strong>City:</strong> <?php echo $state; ?></p>
                                <p><strong>District:</strong> <?php echo $district; ?></p>
                                <p><strong>Address:</strong> <?php echo $address; ?></p>
                                <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>
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
                        <label for="editIC" class="form-label">IC</label>
                        <input type="text" class="form-control" id="editIC" name="studIC" value="<?php echo $ic; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editDOB" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="editDOB" name="studDOB" value="<?php echo $DOB; ?>" onchange="calculateAge()">
                    </div>
                    <div class="mb-3">
                        <label for="editAge" class="form-label">Age</label>
                        <input type="number" class="form-control" id="editAge" name="studAge" value="<?php echo $age; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editRace" class="form-label">Race</label>
                        <select class="form-control" id="editRace" name="studRace">
                            <option value="Malay" <?php echo $race == 'Malay' ? 'selected' : ''; ?>>Malay</option>
                            <option value="Chinese" <?php echo $race == 'Chinese' ? 'selected' : ''; ?>>Chinese</option>
                            <option value="Indian" <?php echo $race == 'Indian' ? 'selected' : ''; ?>>Indian</option>
                            <option value="Others" <?php echo $race == 'Others' ? 'selected' : ''; ?>>Others</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="studEmail" value="<?php echo $email; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editPassword" name="studPassword" value="">
                    </div>
                    <div class="mb-3">
                        <label for="editGender" class="form-label">Gender</label>
                        <select class="form-control" id="editGender" name="studGender">
                            <option value="M" <?php echo $gender == 'M' ? 'selected' : ''; ?>>Male</option>
                            <option value="F" <?php echo $gender == 'F' ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="editPhone" name="studPhone" value="<?php echo $phone; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editParentName" class="form-label">Parent Name</label>
                        <input type="text" class="form-control" id="editParentName" name="studParentName" value="<?php echo $parentName; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editParentNo" class="form-label">Parent Number</label>
                        <input type="text" class="form-control" id="editParentNo" name="studParentNo" value="<?php echo $parentNo; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editPostcode" class="form-label">Postcode</label>
                        <input type="text" class="form-control" id="editPostcode" name="studPostcode" value="<?php echo $postcode; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editState" class="form-label">State</label>
                        <select class="form-control" id="editState" name="studState" onchange="updateDistricts()">
                            <?php
                            $states = [
                                "KELANTAN", "PAHANG", "TERENGGANU", "SELANGOR", "SABAH", "SARAWAK", "PERAK", "MELAKA",
                                "KEDAH", "PERLIS", "NEGERI SEMBILAN", "JOHOR", "PULAU PINANG",
                                "WILAYAH PERSEKUTUAN KUALA LUMPUR", "WILAYAH PERSEKUTUAN LABUAN"
                            ];
                            foreach ($states as $state) {
                                echo '<option value="' . $state . '"' . ($state == $state ? ' selected' : '') . '>' . $state . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDistrict" class="form-label">District</label>
                        <select class="form-control" id="editDistrict" name="studDistrict">
                            <option value="" selected>Select District</option>
                        </select>
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
    function updateDistricts() {
        const state = document.getElementById('editState').value;
        const districtSelect = document.getElementById('editDistrict');
        const districts = {
            "KELANTAN": ["Bachok", "Gua Musang", "Jeli", "Kota Bharu", "Kuala Krai", "Machang", "Pasir Mas", "Pasir Puteh", "Tanah Merah", "Tumpat", "Lojing"],
            "PAHANG": ["Bentong", "Bera", "Cameron Highlands", "Jerantut", "Kuantan", "Lipis", "Maran", "Pekan", "Raub", "Rompin", "Temerloh"],
            "TERENGGANU": ["Besut", "Dungun", "Hulu Terengganu", "Kemaman", "Kuala Terengganu", "Marang", "Setiu", "Kuala Nerus"],
            "SELANGOR": ["Gombak", "Hulu Langat", "Hulu Selangor", "Klang", "Kuala Langat", "Kuala Selangor", "Petaling", "Sabak Bernam", "Sepang"],
            "SABAH": ["Bahagian Kudat", "Kota Marudu", "Kudat", "Pitas", "Kota Kinabalu Bahagian Pantai Barat", "Kota Belud", "Kota Kinabalu", "Papar", "Penampang", "Putatan", "Ranau", "Tuaran", "Bahagian Pedalaman", "Beaufort", "Keningau", "Kuala Penyu", "Nabawan", "Sipitang", "Tambunan", "Tenom", "Bahagian Sandakan", "Beluran", "Kinabatangan", "Sandakan", "Telupid", "Tongod", "Bahagian Tawau", "Kalabakan", "Kunak", "Lahad Datu", "Semporna", "Tawau"],
            "SARAWAK": ["Bahagian Betong", "Betong", "Saratok", "Kabong", "Pusa", "Bahagian Bintulu", "Bintulu", "Tatau", "Bahagian Kapit", "Belaga", "Kapit", "Song", "Bahagian Kuching", "Bau", "Kuching", "Lundu", "Bahagian Limbang", "Lawas", "Limbang", "Bahagian Miri", "Marudi", "Miri", "Subis", "Bahagian Mukah", "Dalat", "Daro", "Matu", "Mukah", "Bahagian Samarahan", "Asajaya", "Samarahan", "Simunjan", "Bahagian Sarikei", "Julau", "Meradong", "Sarikei", "Pakan", "Bahagian Serian", "Serian", "Tebedu", "Bahagian Sibu", "Kanowit", "Selangau", "Sibu", "Bahagian Sri Aman", "Lubok Antu", "Sri Aman"],
            "PERAK": ["Batang Padang", "Hilir Perak", "Hulu Perak", "Kampar", "Kerian", "Kinta", "Kuala Kangsar", "Larut, Matang dan Selama", "Manjung", "Muallim", "Perak Tengah", "Bagan Datuk"],
            "MELAKA": ["Alor Gajah", "Melaka Tengah", "Jasin"],
            "KEDAH": ["Baling", "Bandar Baharu", "Kota Setar", "Kuala Muda", "Kubang Pasu", "Kulim", "Langkawi", "Padang Terap", "Pendang", "Pokok Sena", "Sik", "Yan"],
            "PERLIS": ["none"],
            "NEGERI SEMBILAN": ["Jelebu", "Jempol", "Kuala Pilah", "Port Dickson", "Rembau", "Seremban", "Tampin"],
            "JOHOR": ["Batu Pahat", "Johor Bahru", "Kluang", "Kota Tinggi", "Kulai", "Mersing", "Muar", "Pontian", "Segamat", "Tangkak"],
            "PULAU PINANG": ["Timur Laut", "Barat Daya", "Seberang Perai Utara", "Seberang Perai Tengah", "Seberang Perai Selatan"],
            "WILAYAH PERSEKUTUAN KUALA LUMPUR": ["none"],
            "WILAYAH PERSEKUTUAN LABUAN": ["none"]
        };

        districtSelect.innerHTML = ""; // Clear existing options

        if (districts[state]) {
            districts[state].forEach(function(district) {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.value = "";
            option.textContent = "Select District";
            districtSelect.appendChild(option);
        }
    }

    // Initialize districts on page load if city is already selected
    document.addEventListener('DOMContentLoaded', function() {
        updateDistricts();
    });

    function calculateAge() {
        const dob = new Date(document.getElementById('editDOB').value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        document.getElementById('editAge').value = age;
    }

    // Add event listener for form submission
    document.getElementById('editProfileForm').addEventListener('submit', function(event) {
        const name = document.getElementById('editName').value;
        const ic = document.getElementById('editIC').value;
        const email = document.getElementById('editEmail').value;
        const phone = document.getElementById('editPhone').value;
        const parentName = document.getElementById('editParentName').value;
        const parentNo = document.getElementById('editParentNo').value;
        const postcode = document.getElementById('editPostcode').value;

        // Validate name (no numbers allowed)
        if (/\d/.test(name)) {
            alert('Name should not contain numbers.');
            event.preventDefault();
            return false;
        }

        // Validate IC number (numeric characters only, no special characters)
        if (!/^\d+$/.test(ic)) {
            alert('IC should contain numbers only and no special characters.');
            event.preventDefault();
            return false;
        }

        // Validate email
        if (email.trim() === '') {
            alert('Please enter your email.');
            event.preventDefault();
            return false;
        }

        // Validate phone number (numeric characters only, no special characters)
        if (!/^\d+$/.test(phone)) {
            alert('Phone number should contain numbers only and no special characters.');
            event.preventDefault();
            return false;
        }

        // Validate parent name (no numbers allowed)
        if (/\d/.test(parentName)) {
            alert('Parent name should not contain numbers.');
            event.preventDefault();
            return false;
        }

        // Validate parent phone number (numeric characters only, no special characters)
        if (!/^\d+$/.test(parentNo)) {
            alert('Parent phone number should contain numbers only and no special characters.');
            event.preventDefault();
            return false;
        }

        // Validate postcode (numeric characters only, no special characters)
        if (!/^\d+$/.test(postcode)) {
            alert('Postcode should contain numbers only and no special characters.');
            event.preventDefault();
            return false;
        }
    });
</script>
</body>

</html>