<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

// Handle record deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the record based on the provided ID
    $stmt_delete = $conn->prepare("DELETE FROM useraccount_tbl WHERE id = :id");
    $stmt_delete->execute([':id' => $delete_id]);

    // Redirect back to the form after deletion
    header('Location: register.php');
    exit();
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $lot = isset($_POST['lot']) ? (int)$_POST['lot'] : 0; // Ensure `lot` is an integer
    $block = $_POST['block'];
    $phase = $_POST['phase'];  // Get the hidden phase value
    $address = $_POST['address'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];

    // Validate lot range (1 to 50)
    if ($lot < 1 || $lot > 50) {
        $message[] = 'Lot number is 1 to 50 only.';
    }

    // Validate phase based on selected block
    elseif (in_array($block, ['block 1', 'block 2', 'block 3']) && $phase != 'phase 1') {
        $message[] = 'If Block 1, 2, or 3 is selected, Phase 1 must be chosen!';
    } elseif (in_array($block, ['block 4', 'block 5', 'block 6']) && $phase != 'phase 2') {
        $message[] = 'If Block 4, 5, or 6 is selected, Phase 2 must be chosen!';
    } else {
        // Check if user or address exists
        $stmt = $conn->prepare("SELECT * FROM useraccount_tbl WHERE email = :email");
        $stmt->execute([':email' => $email]);

        $stmt_location = $conn->prepare("SELECT * FROM useraccount_tbl WHERE lot = :lot AND block = :block AND phase = :phase AND address = :address");
        $stmt_location->execute([':lot' => $lot, ':block' => $block, ':phase' => $phase, ':address' => $address]);

        if ($stmt->rowCount() > 0) {
            $message[] = 'User already exists!';
        } elseif ($stmt_location->rowCount() > 0) {
            $message[] = 'Lot, block, phase, and address combination already taken!';
        } else {
            if ($pass != $cpass) {
                $message[] = 'Confirm password not matched!';
            } else {
                // Insert the new user with security question and answer
                $stmt_insert = $conn->prepare("INSERT INTO useraccount_tbl (name, email, lot, block, phase, address, password, security_question, security_answer) VALUES (:name, :email, :lot, :block, :phase, :address, :password, :security_question, :security_answer)");
                $stmt_insert->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':lot' => $lot,
                    ':block' => $block,
                    ':phase' => $phase,  // Store the phase value
                    ':address' => $address,
                    ':password' => password_hash($pass, PASSWORD_BCRYPT),
                    ':security_question' => $security_question,
                    ':security_answer' => $security_answer
                ]);
                $message[] = 'Registered successfully!';
                header('Location: login.php');
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
<center>
    <br><br><br><br><br><br><br>

    <?php
    // Display any messages if set
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
            <div class="message">
                <span>' . $message . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
    ?>

    <div class="form-container">
        <form action="" method="post">
            <h3>Register Now</h3>
            <!-- Existing fields -->
            <input type="name" name="name" placeholder="Enter your firstname" required class="box">
            <input type="number" name="lot" placeholder="Lot" min="1" max="50" required class="box">

            <!-- Block and hidden Phase fields -->
            <select name="block" id="block" required class="box" onchange="updatePhase()">
                <option value="block 1">Block 1</option>
                <option value="block 2">Block 2</option>
                <option value="block 3">Block 3</option>
                <option value="block 4">Block 4</option>
                <option value="block 5">Block 5</option>
                <option value="block 6">Block 6</option>
            </select>

            <!-- Hidden input for Phase -->
            <input type="hidden" name="phase" id="phase">

            <select name="address" required class="box">
                <option value="Dela Costa Homes V, Rodriguez, Rizal">Dela Costa Homes V, Rodriguez, Rizal</option>
            </select>

            <input type="email" name="email" placeholder="Enter your email" required class="box">
            <input type="password" name="password" placeholder="Enter your password" required class="box">
            <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">

            <select name="security_question" required class="box">
                <option value="">Select a security question</option>
                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                <option value="What was your first school?">What was your first school?</option>
                <option value="What is your favorite book?">What is your favorite book?</option>
            </select>
            <input type="text" name="security_answer" placeholder="Answer to security question" required class="box">

            <input type="submit" name="submit" value="Register Now" class="btn">
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </form>
    </div>
</center>

<script>
// JavaScript to automatically set phase based on selected block
function updatePhase() {
    var block = document.getElementById('block').value;
    var phaseField = document.getElementById('phase');

    if (block === 'block 1' || block === 'block 2' || block === 'block 3') {
        phaseField.value = 'phase 1';  // Automatically set Phase 1
    } else if (block === 'block 4' || block === 'block 5' || block === 'block 6') {
        phaseField.value = 'phase 2';  // Automatically set Phase 2
    }
}
</script>

</body>
</html>
