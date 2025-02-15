<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Check if the email exists and fetch the security question
    $stmt = $conn->prepare("SELECT security_question FROM useraccount_tbl WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $security_question = $user['security_question'];
    } else {
        $message = 'No user found with that email address!';
    }
}

if (isset($_POST['verify_answer'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $security_answer = $_POST['security_answer'];

    // Verify the security answer
    $stmt = $conn->prepare("SELECT * FROM useraccount_tbl WHERE email = :email AND security_answer = :security_answer");
    $stmt->execute([':email' => $email, ':security_answer' => $security_answer]);
    
    if ($stmt->rowCount() > 0) {
        // If the answer is correct, redirect to the reset password page with the email as a parameter
        header("Location: reset_password.php?email=" . urlencode($email));
        exit();
    } else {
        $message = 'Incorrect answer to the security question.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login.css">
</head>
<body><center>
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
    <div class="form-container">
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
        <?php if (!isset($security_question)): ?>
            <!-- Step 1: Enter email to get security question -->
            <form action="" method="post">
                <h3>Forgot Password</h3>
                <input type="email" name="email" placeholder="Enter your email" required class="box">
                <input type="submit" name="submit" value="Submit" class="btn">
            </form>
        <?php else: ?>
            <!-- Step 2: Show security question and ask for answer -->
            <form action="" method="post">
                <h3>Security Question</h3>
                <p><?php echo htmlspecialchars($security_question); ?></p>
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <input type="text" name="security_answer" placeholder="Answer to security question" required class="box">
                <input type="submit" name="verify_answer" value="Verify Answer" class="btn">
            </form>
        <?php endif; ?>
    </div>
</center>
 
</body>
</html>
