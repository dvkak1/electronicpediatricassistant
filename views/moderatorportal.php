<?php

require_once "../controllers/authenticationControllers/moderatorLoginController.php";


if (!isset($_SESSION['modID'])) {
  header('location:../views/moderatorlogin.php');
  exit();
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Welcome to EpedA - Electronic Pediatric Assistant</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
  crossorigin="anonymous"/>
  <link rel="stylesheet" href="moderatorstyle.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <script src="jquery-3.5.1.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
</head>
<body>
  <header>
  <div class="logo">
   <h1 class="logo-text">E<span>ped</span>A</h1>
  </div>
  </header>
    <div class="moderator-wrapper">
      <div class="left-sidebar">
        <ul>
          <li><a href="#">Notification</a></li>
          <li><a href="managecontent.php">Manage Content</a></li>
          <li><a href="managearticles.php">Articles</a></li>
          <li><a href="moderatorlogin.php?logout=1">Logout</a></li>
        </ul>
      </div>
      <div class="moderator-content">
        <a href="addcontent.php" class="btn">Add Content</a>
        <div class="content">
         <center>
           <h1>Welcome to the moderator portal</h1>
         </center>
        </div>
      </div>
    </div>
</body>
</html>
