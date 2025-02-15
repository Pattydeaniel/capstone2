<?php
session_start();
include 'config.php';

if (isset($_SESSION['user_id'])) {
    header('location: dashboard.php');
    exit;
}

if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Prepare the SQL query using PDO
   $stmt = $conn->prepare("SELECT * FROM useraccount_tbl WHERE email = ?");
   $stmt->execute([$email]);
   $user = $stmt->fetch(PDO::FETCH_ASSOC);  // Fetch the result

   if ($user && password_verify($password, $user['password'])) {
       // Password matches, start the session and log the login time
       $_SESSION['user_id'] = $user['id'];
       
       // Update the last login time
       $update_stmt = $conn->prepare("UPDATE useraccount_tbl SET last_login = NOW() WHERE id = ?");
       $update_stmt->execute([$user['id']]);
       
       header("Location: dashboard.php");
       exit;
   } else {
       echo "<script>alert('Invalid email or password');</script>";
   }
}


// Rest of your code...
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

 
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


<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">
   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="Enter Your Email" required class="box">
      <input type="password" name="password" id="password" placeholder="Enter Your Password"  required class="box">
    <label> <input type="checkbox" onclick="togglePassword()"> Show Password</label>
      <input type="submit" name="submit" value="login now" class="btn">
      <p><a href="forgot.password.php">Forgot Password </a></p>
      <p>Don't have an account? <a href="register.php">Sign Up</a></p>
   </form>

</div></center>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>

</body>
</html>