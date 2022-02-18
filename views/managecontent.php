<?php
include "../controllers/displayController/displayAllPostsController.php";
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
        <li><a href="managearticles.php">Articles</a></li>
        <li><a href="moderatorlogin.php?logout=1">Logout</a></li>
      </ul>
    </div>
    <div class="moderator-content">
      <a href="addcontent.php" class="btn">Add Content</a>
      <br>
      <div class="content">
        <center>
          <br><br>
          <table>
            <thead>
              <th>Post number</th>
              <th>Title</th>
              <th>Post</th>
              <th colspan="2">Action</th>
            </thead>
            <?php
            foreach($allPosts AS $allPost){
            echo "<tbody>";
            echo "<td>". $allPost['postsID']. "</td>";
            echo "<td>". $allPost['topic'] ."</td>";
            echo "<td>". $allPost['posts']. "</td>";
            echo '<td><a href="posts.php" style="text-decoration: none;" class="activate">Publish</a></td>';
            echo '<td><a href="posts.php" style="text-decoration: none;" class="deactivate">Unpublish</a></td>';
            echo '<td><a href=updatecontent.php?postno='. $allPost['postsID'].'  style="text-decoration: none;">Update</a></td>';
            echo "</tbody>";
           }
          ?>
          </table>
        </center>
      </div>
    </div>
  </div>
</body>
</html>
