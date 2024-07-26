<?php
$title = "Profile";
include 'StudentHeader.php'; ?>
<?php
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
        $email = $row['studEmail'];
        $gender = $row['studGender'];
        $state = $row['studState'];
        $district = $row['studDistrict'];
        $poscode = $row['studPoscode'];
        $address = $row['studAddress'];
        $phone = $row['studPhone'];
        $DOB = $row['studDOB'];
        $race = $row['studRace'];
    }
}

if ($gender == 'M') {
    $gender = "Male";
} else if ($gender == 'F') {
    $gender = "Female";
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
                                <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                                <p><strong>Date of Birth:</strong> <?php echo $DOB; ?></p>
                                <p><strong>Race:</strong> <?php echo $race; ?></p>
                                <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>
                                <p><strong>State:</strong> <?php echo $state; ?></p>
                                <p><strong>District:</strong> <?php echo $district; ?></p>
                                <p><strong>Poscode:</strong> <?php echo $poscode; ?></p>
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
                        <label for="editGender" class="form-label">Gender</label>
                        <select class="form-control" id="editGender" name="studGender" required>
                            <option value="">Select a gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
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
                        <label for="editState" class="form-label">State</label>
                        <select class="form-control" id="editState" name="studState" required>
                            <option value="">Select a state</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Perak">Perak</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Johor">Johor</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                            <option value="Wilayah Persekutuan Labuan">Wilayah Persekutuan Labuan</option>
                        </select>
                    </div>
                    <div class="mb-3" id="bahagianWrapper" style="display: none;">
                        <label for="editBahagian" class="form-label">Bahagian</label>
                        <select class="form-control" id="editBahagian" name="studBahagian">
                            <option value="">Select a Bahagian</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDistrict" class="form-label">District</label>
                        <select class="form-control" id="editDistrict" name="studDistrict" required>
                            <option value="">Select a district</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editPoscode" class="form-label">Poscode</label>
                        <input type="text" class="form-control" id="editPoscode" name="studPoscode" value="<?php echo $poscode; ?>">
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

    // Districts data
    const districtsData = {
        "Johor": ["Batu Pahat", "Johor Bahru", "Kluang", "Kota Tinggi", "Kulai", "Mersing", "Muar", "Pontian", "Segamat", "Tangkak"],
        "Kedah": ["Baling", "Bandar Baharu", "Kota Setar", "Kuala Muda", "Kubang Pasu", "Kulim", "Langkawi", "Padang Terap", "Pendang", "Pokok Sena", "Sik", "Yan"],
        "Kelantan": ["Bachok", "Gua Musang", "Jeli", "Kota Bharu", "Kuala Krai", "Machang", "Pasir Mas", "Pasir Puteh", "Tanah Merah", "Tumpat", "Lojing"],
        "Melaka": ["Alor Gajah", "Melaka Tengah", "Jasin"],
        "Negeri Sembilan": ["Jelebu", "Jempol", "Kuala Pilah", "Port Dickson", "Rembau", "Seremban", "Tampin"],
        "Pahang": ["Bentong", "Bera", "Cameron Highlands", "Jerantut", "Kuantan", "Lipis", "Maran", "Pekan", "Raub", "Rompin", "Temerloh"],
        "Perak": ["Batang Padang", "Hilir Perak", "Hulu Perak", "Kampar", "Kerian", "Kinta", "Kuala Kangsar", "Larut, Matang dan Selama", "Manjung", "Muallim", "Perak Tengah", "Bagan Datuk"],
        "Perlis": ["N/A"],
        "Pulau Pinang": ["Timur Laut", "Barat Daya", "Seberang Perai Utara", "Seberang Perai Tengah", "Seberang Perai Selatan"],
        "Sabah": {
            "Bahagian Kudat": ["Kota Marudu", "Kudat", "Pitas"],
            "Kota Kinabalu Bahagian Pantai Barat": ["Kota Belud", "Kota Kinabalu", "Papar", "Penampang", "Putatan", "Ranau", "Tuaran"],
            "Bahagian Pedalaman": ["Beaufort", "Keningau", "Kuala Penyu", "Nabawan", "Sipitang", "Tambunan", "Tenom"],
            "Bahagian Sandakan": ["Beluran", "Kinabatangan", "Sandakan", "Telupid", "Tongod"],
            "Bahagian Tawau": ["Kalabakan", "Kunak", "Lahad Datu", "Semporna", "Tawau"]
        },
        "Sarawak": {
            "Bahagian Betong": ["Betong", "Saratok", "Kabong", "Pusa"],
            "Bahagian Bintulu": ["Bintulu", "Tatau"],
            "Bahagian Kapit": ["Belaga", "Kapit", "Song"],
            "Bahagian Kuching": ["Bau", "Kuching", "Lundu"],
            "Bahagian Limbang": ["Lawas", "Limbang"],
            "Bahagian Miri": ["Marudi", "Miri", "Subis"],
            "Bahagian Mukah": ["Dalat", "Daro", "Matu", "Mukah"],
            "Bahagian Samarahan": ["Asajaya", "Samarahan", "Simunjan"],
            "Bahagian Sarikei": ["Julau", "Meradong", "Sarikei", "Pakan"],
            "Bahagian Serian": ["Serian", "Tebedu"],
            "Bahagian Sibu": ["Kanowit", "Selangau", "Sibu"],
            "Bahagian Sri Aman": ["Lubok Antu", "Sri Aman"]
        },
        "Selangor": ["Gombak", "Hulu Langat", "Hulu Selangor", "Klang", "Kuala Langat", "Kuala Selangor", "Petaling", "Sabak Bernam", "Sepang"],
        "Terengganu": ["Besut", "Dungun", "Hulu Terengganu", "Kemaman", "Kuala Terengganu", "Marang", "Setiu", "Kuala Nerus"],
        "Wilayah Persekutuan Kuala Lumpur": ["N/A"],
        "Wilayah Persekutuan Labuan": ["N/A"]
    };

    document.getElementById('editState').addEventListener('change', function() {
        var state = this.value;
        var bahagianWrapper = document.getElementById('bahagianWrapper');
        var bahagianSelect = document.getElementById('editBahagian');
        var districtSelect = document.getElementById('editDistrict');

        // Clear current bahagian and district options
        bahagianSelect.innerHTML = '<option value="">Select a Bahagian</option>';
        districtSelect.innerHTML = '<option value="">Select a district</option>';

        // Check if the state is Sabah or Sarawak
        if (state === 'Sabah' || state === 'Sarawak') {
            bahagianWrapper.style.display = 'block';
            var bahagianData = Object.keys(districtsData[state]);
            bahagianData.forEach(function(bahagian) {
                var option = document.createElement('option');
                option.value = bahagian;
                option.textContent = bahagian;
                bahagianSelect.appendChild(option);
            });
        } else {
            bahagianWrapper.style.display = 'none';
            if (districtsData[state]) {
                districtsData[state].forEach(function(district) {
                    var option = document.createElement('option');
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
        }
    });

    document.getElementById('editBahagian').addEventListener('change', function() {
        var state = document.getElementById('editState').value;
        var bahagian = this.value;
        var districtSelect = document.getElementById('editDistrict');

        // Clear current district options
        districtSelect.innerHTML = '<option value="">Select a district</option>';

        // Add new options based on selected bahagian
        if (districtsData[state] && districtsData[state][bahagian]) {
            districtsData[state][bahagian].forEach(function(district) {
                var option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        }
    });
</script>


</body>

</html>