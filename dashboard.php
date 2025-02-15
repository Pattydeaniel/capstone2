
<?php
include 'config.php';

session_start();


if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <title>Census web design</title>
  </head>
  <body>
    <div class="container">
      <nav>
        <ul class="nav__links nav__left">
        <li><a href="" class="logo">HOME</a></li>
          <li><a href="about.php" class="logo">ABOUT</a></li>
          <li><a href="feedback.php" class="logo">CONCERN</a></li>
          <li><a href="download.php" class="logo">DOWNLOAD APP</a></li>
        </ul>
        <div class="icons">
            <div id="user-btn" class="fas fa-user"></div>
            <a href=""><i class=""></i> <span></span> </a>
         </div>

         <div class="user-box">
         <a href="logout.php" class="delete-btn">Logout</a>
      
      <span class="letter-s"></span> 
      <img src="census1.png" alt="CENSUS IMAGE" />
      <a href="register.html"><button class="btn explore">REGISTER HERE!!</button></a>
      <h5 class="feature-1">EASY</h5>
      <h5 class="feature-2">ACCESIBLE</h5>
      <h5 class="feature-3">CONVENIENT</h5>
      <h5 class="feature-4">FLEXIBLE</h5>
      <footer class="footer">
        <p>Copyright © 2024. All rights reserved.</p>
        <div class="footer__links">
        </div>
      </footer>
    </div>
</nav>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
  </body>
</html>
