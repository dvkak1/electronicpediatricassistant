<?php
include "../controllers/moderator-controllers/updatePostController.php";
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
          <li><a href="manageposts.php">Posts</a></li>
          <li><a href="managearticles.php">Articles</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </div>
      <div class="moderator-content">
        <center>
        <div class="post-content" id="post-form">
        <h2>Update Post</h2>
           <form action="updateposts.php" method="POST">
             <input type="hidden" name="postID" value="<?= $postID ?>">
             <select class="text-input" name="topic">
               <option value="Reliability">Reliability</option>
               <option value="Accessibility">Accessibility</option>
               <option value="Security">Security</option>
               <option value="About Us">About Us</option>
               <option value="Home Page">Home Page</option>
             </select><br>
             <textarea class="text-input" placeholder="Enter post here..." name="post"><?= $postContent ?></textarea><br>
             <input type="submit" class="btn" value="Update Post" name="update-post">
           </form>
         </div>
       </center>
     </div>
   </div>
</body>
</html>
