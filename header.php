<?php include "dropdownControllerFindPedia.php"; ?>

<header>
  <div class="logo">
    <h1 class="logo-text"><a href="index.php">E<span>ped</span>A</a></h1>
  </div>
  <i class="fa fa-bars menu-toggle"></i>
   <ul class="nav">
    <li><a href="aboutus.php">About Us</a></li>
    <li><a href="#">Find Pediatrician</a>
    <?php
      echo "<ul>";
      while($row = $resultdropdown->fetch_assoc()) {
      echo "<li><a href='findpediatrician.php?spec=".$row['specializationID']."'>".$row['specialization_name']."</a></li>";
    }
      echo "</ul>";
      echo "</li>";

    ?>
    <li><a href="clinic.php">Clinic</a></li>
    <li><a href="govtlinks.php">Government Links</a></li>
    <li>
      <a href="#">Sign In</a>
      <ul>
        <li><a href="login.php">Sign in as Doctor</a></li>
        <li><a href="doctorassistantsignin.php">Sign in as Doctor Assistant</a></li>
        <li><a href="signinaspatient.php">Sign in as Patient</a></li>
      </ul>
    </li>
    <li><a href="register.php">Register</a></li>
  </ul>
</header>
