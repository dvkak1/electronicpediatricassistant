<?php

include "../controllers/administrator-controllers/add-moderator-Controller.php";
include "../controllers/notificationControllers/newRegisteredDoctor.php";

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to EpedA - Electronic Pediatric Assistant</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<link rel="stylesheet" href="../views/adminstyle.css">
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

  <div class="admin-wrapper">
    <div class="left-sidebar">
      <ul>
        <li><a href="adminindex.php">Manage Doctors<div id="notifLab"><?php echo $rowNum ?></div></a></li>
        <li><a href="#">Deactivated Doctors</a></li>
        <li><a href="approveddoctors.php">Approved Doctors</a></li>
        <li><a href="addmoderator.php">Add Moderator</a></li>
        <li><a href="moderatormanagement.php">Manage Moderators</a></li>
        <li><a href="#">Delete Moderators</a></li>
      </ul>
    </div>
   <div class="admin-content">
     <center>
     <div class="admin-addmoderator-content" id="post-form">
       <div class="form-title">
       <h2 style="font-family: Goldman;">Add New Moderator</h2>
      </div>
      <?php if(count($inputErrors) > 0):
        foreach($inputErrors as $inputError):
          echo $inputError . "<br>";
        endforeach;
      endif;
        ?>
        <?php if (isset($_SESSION['moderatorMessage'])){
          echo $_SESSION['moderatorMessage'];
        }unset($_SESSION['moderatorMessage']);
        ?>
        <form action="addmoderator.php" method="POST">
          <input type="text" class="text-input" placeholder="First Name" name="modFirstName"><br>
          <input type="text" class="text-input" placeholder="Middle Name" name="modMiddleName"><br>
          <input type="text" class="text-input" placeholder="Last Name"  name="modLastName"><br>
          <input type="text" class="text-input" placeholder="Username"  name="username"><br>
          <input type="date" name="bdate"  class="text-input"><br>
          <input type="text" class="text-input" placeholder="Mobile Number"  name="modmobNo"><br>
          <input type="password" class="text-input" placeholder="Passcode" name="passcode"><br>
          <input type="password" class="text-input" placeholder="Confirm Passcode" name="passcodeConf"><br>
          <input type="submit" class="btn" value="Add Moderator" name="add-moderator">
        </form>
      </div>
    </center>
  </div>
 </div>
