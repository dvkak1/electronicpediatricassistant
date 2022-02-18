<?php

require_once "../controllers/authenticationControllers/loginController.php";
require_once "../controllers/displayController/dropdownPediatricianController.php";
require_once "../controllers/displayController/dropdownClinicController.php";
// require_once "../controllers/authenticationControllers/reset-password-controller.php";

if (isset($_GET['token'])) {
  $token = $_GET['token'];
  verifyDoctor($token);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
</head>
<center>
<body>
  <header>
    <div class="logo">
      <h1 class="logo-text"><a href="../index.php">E<span>ped</span>A</a></h1>
    </div>
    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav">
      <li><a href="aboutus.php">About Us</a></li>
      <li><a href="#">Find Pediatrician</a>
      <?php
        echo "<ul>";
        while($row = $result_spec_show->fetch_assoc()) {
        echo "<li><a href='findpediatrician.php?spec=".$row['specializationID']."'>".$row['specialization_name']."</a></li>";
      }
        echo "</ul>";
        echo "</li>";

      ?>
        <li><a href="#">Clinic</a>
          <?php
            echo "<ul>";
            while($row_clinic = $result_dropdown->fetch_assoc()) {
            echo "<li><a href='publicdoctorportal.php?pedID=".$row_clinic['pediaID']."'>".$row_clinic['name']."</a></li>";
          }
            echo "</ul>";
            echo "</li>";

          ?>
      <li><a href="govtlinks.php">Government Links</a></li>
      <li>
        <a href="#">Sign In</a>
        <ul>
          <li><a href="signin.php">Sign in as Doctor</a></li>
          <li><a href="doctorassistantlogin.php">Sign in as Doctor Assistant</a></li>
          <li><a href="signintopatientportal.php">Sign in as Patient</a></li>
        </ul>
      </li>
      <li><a href="register.php">Register</a></li>
    </ul>
  </header>
<div class="auth-content">
  <div class="form-title">
    <h2>Sign in</h2>
  </div>
  <form action="signin.php" method="POST">

    <?php if (isset($_SESSION['notVerMessage'])){
      echo $_SESSION['notVerMessage'];
    }unset($_SESSION['notVerMessage']);?>

    <?php if(count($errors) > 0):
      foreach($errors as $error):
        echo $error . "<br>";
      endforeach;
    endif;
      ?>

      <input type="text" placeholder="Email" name="emailuname" class="text-input"><br>
      <input type="password" placeholder="Password" name="pword"  class="text-input"><br>
    <div style="font-size: 0.8em; text-align:center;">
      <a href="forgot-password.php">Forgot your password?</a>
    </div>
      <input type="submit" value="Log In" name="login-btn" class="btn">
  </form>
</div>
</div>
</center>
</body>
</html>



<!--
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" display="width-device-width, initial-scale=1.0">
  <title>EpedA - Electronic Pediatric Assistant</title>
</head>
<body>
  <nav>
    <a href="../index.php" class="logo">EpedA</a>
    <ul>
      <li><a href="aboutus.php">About Us</a></li>
      <li><a href="govtlinks.php">Government Links</a></li>
    </ul>
  </nav>
  <center>
    <div class="wrapper">
      <div class="form">
    <form action="signin.php" method="POST">
      <div class="title">
        Sign In Form
      </div>

      <-?php if (isset($_SESSION['notVerMessage'])){
        echo $_SESSION['notVerMessage'];
      } unset($_SESSION['notVerMessage']);?>

        <-?php if(count($errors) > 0):
          foreach($errors as $error):
            echo $error . "<br>";
          endforeach;
        endif;
          ?>

      <div class="input_field">
        <input type="text" class="input" placeholder="Email" name="emailuname" value="<-?= $emailuname ?>">
      </div>
      <div class="input_field">
        <input type="password" class="input" placeholder="Password" name="pword" value="<-?= $password ?>">
      </div>
      <div style="font-size: 0.8em; text-align:center;">
      <a href="forgot-password.php">Forgot your password?</a>
    </div><br>
      <div class="submit_field">
        <input type="submit" value="Submit" class="btn" name="login-btn">
      </div>
    </form>
  </div>
</div>
  </center>
</body> -->
