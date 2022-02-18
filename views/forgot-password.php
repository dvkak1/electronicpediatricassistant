<?php

require_once "../controllers/authenticationControllers/forgot-password-controller.php";
require_once "../controllers/displayController/dropdownPediatricianController.php";

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<meta name="viewport" content="width-device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
<head>
  <meta charset="utf-8">
  <title>EpedA - Electronic Pediatric Assistant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="logo">
      <h1 class="logo-text"><a href="../index.php">E<span>ped</span>A</a></h1>
    </div>
    <i class="fa fa-bars menu-toggle"></i>
     <ul class="nav">
      <li><a href="views/aboutus.php">About Us</a></li>
      <li><a href="#">Find Pediatrician</a>
      <?php
        echo "<ul>";
        while($row = $result_spec_show->fetch_assoc()) {
        echo "<li><a href='views/findpediatrician.php?spec=".$row['specializationID']."'>".$row['specialization_name']."</a></li>";
      }
        echo "</ul>";
        echo "</li>";

      ?>
      <li><a href="clinic.php">Clinic</a></li>
      <li><a href="views/govtlinks.php">Government Links</a></li>
      <li>
        <a href="#">Sign In</a>
        <ul>
          <li><a href="views/signin.php">Sign in as Doctor</a></li>
          <li><a href="views/doctorassistantlogin.php">Sign in as Doctor Assistant</a></li>
          <li><a href="views/signintopatientportal.php">Sign in as Patient</a></li>
        </ul>
      </li>
      <li><a href="views/register.php">Register</a></li>
    </ul>
  </header>

  <center>
  <div class="auth-content">
    <div class="form-title">
      <h2>Forgot Password?</h2>
    </div>
    <form action="forgot-password.php" method="POST">
      <input type="text" class="text-input" name="email" placeholder="Please enter your email"><br>
      <input type="submit" name="forgot-password" value="Reset Password" class="btn">
    </form>
  </div>
  </center>
    <?php include("../templates/footer.php")?>
</body>
