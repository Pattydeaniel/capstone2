<?php
include 'config.php';
session_start();

if (isset($_POST['send'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];

    try {
        // Prepare the SQL statement with placeholders
        $stmt = $conn->prepare("INSERT INTO message (name, email, number, message) VALUES (:name, :email, :number, :message)");
        
        // Bind values to the placeholders
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':message', $message);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "<script>alert('Message sent successfully!');</script>";
        } else {
            echo "<script>alert('Error: Could not send message.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="login.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="heading"></div>

<section class="contact">
   <form action="" method="post">
      <h3>CONCERN IN WEBSITE</h3>
      <input type="text" name="name" required placeholder="Enter Your Name" class="box">
      <input type="email" name="email" required placeholder="Enter Your Email" class="box">
      <input type="number" name="number" required placeholder="Enter Your Number" class="box">
      <textarea name="message" class="box" placeholder="Enter Your Message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>
</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>
