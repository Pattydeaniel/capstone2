<?php
session_start();

$servername = 'localhost';
$db = 'censusonl_census_db';
$user = 'censusonl_censusonline';
$pass = 'Cx3SiZYulOq0';

// Create the database connection
$conn = new mysqli($servername, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Store email, lot, block, and household income in session
if (isset($_POST['email'])) {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['lot'] = $_POST['lot'];
    $_SESSION['block'] = $_POST['block'];
    $_SESSION['household_income'] = $_POST['household_income'];
}

// Get other form inputs
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$age = $_POST['age'];
$occupation = $_POST['occupation'];
$marital_status = $_POST['marital_status'];
$gender = $_POST['gender'];
$lot = $_POST['lot'];
$block = $_POST['block'];
$address = $_POST['address'];
$date_of_birth = $_POST['date_of_birth'];
$religion = $_POST['religion'];
$household_income = $_POST['household_income'];
$family_role = $_POST['family_role'];
$email = $_POST['email']; // Ensure email is retrieved here

// Set phase based on the selected block
if (in_array($block, ["block 1", "block 2", "block 3"])) {
    $phase = "Phase 1";
} elseif (in_array($block, ["block 4", "block 5", "block 6"])) {
    $phase = "Phase 2";
} else {
    $phase = null;
}

// Check if file is uploaded successfully
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    // Prepare the SQL query with email and family_role added
    $sql = "INSERT INTO queue_tbl (firstname, middlename, lastname, age, occupation, marital_status, gender, lot, block, phase, address, date_of_birth, religion, household_income, family_role, email, valid_id)
            VALUES ('$firstname', '$middlename', '$lastname', '$age', '$occupation', '$marital_status', '$gender', '$lot', '$block', '$phase', '$address', '$date_of_birth', '$religion', '$household_income', '$family_role', '$email', '$imgContent')";

    if ($conn->query($sql) === TRUE) {
        echo "Record uploaded successfully.";
        header("Location: next3.html");
        exit(); // Stop further execution after redirect
    } else {
        echo "Upload failed: " . $conn->error;
    }
} else {
    echo "No image uploaded or there was an error with the upload.";
}

$conn->close();
?>
