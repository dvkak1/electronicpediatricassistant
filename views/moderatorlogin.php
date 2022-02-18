<?php
require_once "../controllers/authenticationControllers/moderatorLoginController.php";
?>

<!DOCTYPE html>
<head>
  <html lang="en">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
  crossorigin="anonymous"/>
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
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
      <li><a href="#">Find Pediatrician</a></li>
      <!-- <-?php
        echo "<ul>";
        while($row = $result_spec_show->fetch_assoc()) {
        echo "<li><a href='views/findpediatrician.php?spec=".$row['specializationID']."'>".$row['specialization_name']."</a></li>";
      }
        echo "</ul>";
        echo "</li>";

      ?> -->
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
          <h2>Moderator Login Form</h2>
        </div>
        <form action="moderatorlogin.php" method="POST">
            <input type="text" name="moderatoruserName" value="" placeholder="Username" class="text-input"><br>
            <input type="password" name="moderatorPC" value="" placeholder="Passcode" class="text-input"><br>
            <input type="submit" class="btn" name="moderatorlogin-btn" value="Log In">
        </form>
      </div>
    </center>
  <?php include "../templates/footer.php" ?>

</body>
</html>
