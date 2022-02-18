<?php

require_once "../controllers/moderator-controllers/create-post-controller.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <a href="moderatorportal.php" class="logo">ePedA</a>
    <ul>
      <li><a href="manageposts.php">Manage Posts</a></li>
    </ul>
  </nav>
<center>
  <div class="wrapper">
    <div class="form">
      <div class="title">
        Add Post
      </div>
      <form action="posts.php" method="POST">
      <div class="input_field">
        <label>Title</label>
        <input type="text" class="input" name="post-title">
      </div>
      <div class="input_field">
        <label>Post</label>
        <textarea class="input" name="post-body"></textarea>
      </div>
      <div class="submit_field">
        <input type="submit" value="Submit" class="btn" name="create-post">
      </div>
      </form>
    </div>
  </div>
</center>
</body>
</html>
