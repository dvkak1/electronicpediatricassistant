<?php  require_once "controllers/displayController/dropdownPediatricianController.php"; ?>
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
