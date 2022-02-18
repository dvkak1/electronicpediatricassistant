<?php

require_once "../controllers/displayController/dropdownPediatricianController.php";
require_once "../controllers/displayController/dropdownClinicController.php";
require_once "../controllers/authenticationControllers/registrationController.php";
require_once "../controllers/displayController/displayFooterContent.php";

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
        echo "<li><a href='views/findpediatrician.php?spec=".$row['specializationID']."'>".$row['specialization_name']."</a></li>";
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

<center>
  <div class="auth-content">
    <div class="form-title">
      <h2>Register</h2>
    </div>
    <form action="register.php" method="POST">

      <?php if(isset($_SESSION['regMessage'])){
        echo $_SESSION['regMessage'];
      }unset($_SESSION['regMessage']);
      ?>


            <?php if(count($errors) > 0):
              foreach($errors as $error):
                echo $error . "<br>";
              endforeach;
            endif;
              ?>


        <input type="text" placeholder="Email" name="email" class="text-input"><br>
        <input type="text" placeholder="Username" name="username" class="text-input"><br>
        <input type="text" placeholder="First Name" name="firstName" class="text-input"><br>
        <input type="text" placeholder="Middle Name" name="middleName" class="text-input"><br>
        <input type="text" placeholder="Last Name" name="lastName" class="text-input"><br>
        <select name="gender"  class="text-input">
          <option value="Gender">Gender</option>
          <option value="Male">M</option>
          <option value="Female">F</option>
        </select><br>
        <input type="text" placeholder="Specialization" name="pedSpecialization"  class="text-input"><br>
        <input type="text" placeholder="Hospital Affiliation" name="pedHospitalAf"  class="text-input"><br>
        <input type="text" placeholder="Mobile Number" name="mobileNo"  class="text-input"><br>
        <input type="date" name="bdate"  class="text-input"><br>
        <input type="password" placeholder="Password" name="pword"  class="text-input"><br>
        <input type="password" placeholder="Confirm Password" name="confpWord"  class="text-input"><br>
        <p>Already have an account? <a href="signin.php">Sign In</a></p>
        <input type="submit" name="reg-btn" class="btn" value="Register">
      </div>
    </form>
</div>
</center>
<?php include "../templates/footer.php"?>
</body>
<html>
