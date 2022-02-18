<?php
include "../controllers/notificationControllers/newRegisteredDoctor.php"
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
       <li><a href="deactivateddoctors.php">Deactivated Doctors</a></li>
       <li><a href="approveddoctors.php">Approved Doctors</a></li>
       <li><a href="#">Active Doctors</a></li>
       <li><a href="addmoderator.php">Add Moderator</a></li>
       <li><a href="moderatormanagement.php">Manage Moderators</a></li>
       <li><a href="#">Delete Moderators</a></li>
     </ul>
   </div>
     <div class="admin-content">
      <div class="content">
        <h1>Welcome to the admin portal</h1>
     </div>
   </center>
 </body>
 </html>
