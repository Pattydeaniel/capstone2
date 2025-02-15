<?php
include 'config.php';

if (isset($_GET['email'])) {
    $email = filter_var(urldecode($_GET['email']), FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        try {
            // Update the user's password in the database
            $stmt = $conn->prepare("UPDATE useraccount_tbl SET password = :password WHERE email = :email");
            $stmt->execute([':password' => $hashed_password, ':email' => $email]);

            echo "<script>alert('Your password has been reset successfully!'); window.location.href='login.php';</script>";
        } catch (PDOException $e) {
            echo "Error updating password: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <center>
        <div class="form-container">
        <form action="reset_password.php?email=<?php echo urlencode($email); ?>" method="post">
                <h3>Reset Your Password</h3>
                <input type="password" name="new_password" placeholder="Enter your new password" required class="box">
                <input type="password" name="confirm_password" placeholder="Confirm your new password" required class="box">
                <input type="submit" name="reset_password" value="Confirm" class="btn">
            </form>
        </div>
    </center>
</body>
</html>
