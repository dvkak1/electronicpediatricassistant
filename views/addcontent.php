<?php

include "../controllers/moderator-controllers/create-post-controller.php";
require_once "../controllers/authenticationControllers/moderatorLoginController.php";


if (!isset($_SESSION['modID'])) {
  header('location:../views/moderatorlogin.php');
  exit();
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Welcome to EpedA - Electronic Pediatric Assistant</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
  crossorigin="anonymous"/>
  <link rel="stylesheet" href="moderatorstyle.css">
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
  <div class="moderator-wrapper">
      <div class="left-sidebar">
        <ul>
          <li><a href="#">Notification</a></li>
          <li><a href="managecontent.php">Manage Content</a></li>
          <li><a href="moderatorlogin.php?logout=1">Logout</a></li>
        </ul>
      </div>
      <div class="moderator-content">
        <a href="addcontent.php" class="btn">Add Content</a>
        <center>
        <div class="post-content" id="post-form">
        <h2>Add Post</h2>
           <form action="addcontent.php" method="POST">
             <select class="text-input" name="topic">
               <option value="Reliability">Reliability</option>
               <option value="Accessibility">Accessibility</option>
               <option value="Security">Security</option>
               <option value="About Us">About Us</option>
               <option value="Home Page">Home Page</option>
               <option value="Home Page">Footer</option>
             </select><br>
             <textarea class="text-input" placeholder="Enter post here..." name="post"></textarea><br>
             <input type="submit" class="btn" value="Post" name="enter-post">
           </form>
         </div>
       </center>
     </div>
   </div>
</body>
</html>
