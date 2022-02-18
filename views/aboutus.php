<?php
require_once "../controllers/displayController/dropdownPediatricianController.php";
require_once "../controllers/displayController/displayAboutUsContent.php";
require_once "../controllers/displayController/dropdownClinicController.php";
require_once "../controllers/displayController/displayFooterContent.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to EpedA - Electronic Pediatric Assistant</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet"
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
          echo "<li><a href='findpediatrician.php?spec=".$row['specializationID']."'>".$row['specialization_name']."</a></li>";
        }
          echo "</ul>";
          echo "</li>";
        ?>
      <li><a href="clinic.php">Clinic</a>
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

  <div class="page-wrapper">
    <div class="post-slider">
        <h2 class="slider-title"><?= $postAboutUs ?></h2>
<center>
    <div class="post-wrapper">
          <div class="post" id="aboutUsContent">
            <div class="post-info">
              <center>
                <h3><?= $displaypostAboutUsContentTopic1 ?></h3>
                <li style="font-size: 18px;"><?= $postAboutUsContent1 ?></li>
              </center>
            </div>
          </div>
          <div class="post" id ="aboutUsContent">
            <div class="post-info">
              <center>
              <h3><?= $displaypostAboutUsContentTopic2 ?></h3>
              <li style="font-size: 18px;"><?= $postAboutUsContent2 ?></li>
             </center>
            </div>
          </div>
          <div class="post" id="aboutUsContent">
            <div class="post-info">
              <center>
                <h3><?= $displaypostAboutUsContentTopic3 ?></h3>
                <li style="font-size: 18px;"><?= $postAboutUsContent3 ?></li>
             </center>
            </div>
          </div>
      </div>
    </center>
  </div>
  <?php include "../templates/footer.php"?>
</body>
<!-- <p>This is the about us page</p> -->
</html>
