<?php
  require_once "controllers/displayController/dropdownClinicController.php";
  // require_once "controllers/displayController/display-article-controller.php";
  require_once "controllers/displayController/dropdownPediatricianController.php";
  require_once "controllers/displayController/showHomePageController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to EpedA - Electronic Pediatric Assistant</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<link rel="stylesheet" href="views/style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="logo">
      <h1 class="logo-text"><a href="#">E<span>ped</span>A</a></h1>
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
        <li><a href="#">Clinic</a>
          <?php
            echo "<ul>";
            while($row_clinic = $result_dropdown->fetch_assoc()) {
            echo "<li><a href='views/publicdoctorportal.php?pedID=".$row_clinic['pediaID']."'>".$row_clinic['name']."</a></li>";
          }
            echo "</ul>";
            echo "</li>";

          ?>
      <li><a href="views/govtlinks.php">Government Links</a></li>
      <li>
        <a href="#">Sign In</a>
        <ul>
          <li><a href="views/signin.php">Sign in as Doctor</a></li>
          <li><a href="views/doctorassistantlogin.php">Sign in as Doctor Assistant</a></li>
          <li><a href="views/signintopatientportal.php">Sign in as Patient</a></li>
        </ul>
      </li>
      <li>
        <a href="views/register.php">Register</a>
      </li>
    </ul>
  </header>


    <center>
    <h1><?= $homePagePost ?></h1>
     <br>
     <img src="img/childrenhandprints.png"></img>
     <br>
     <img src="img/babywithstethoscope.png" height="250px"></img>
   </center>

  <?php include("templates/footer.php"); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <!--- Custom script for mobile view/media query--->
  <script src="scripts.js"></script>

</body>
</html>
