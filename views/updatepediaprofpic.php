<?php
require_once "../controllers/pedProfInformControllers/updateProfController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" display="width-device width, initial-scale=1.0">
  <title>EpedA - Electronic Pediatric Assistant</title>
</head>
<body>
  <body>
    <nav>
      <ul>
        <a href="index.php" class="logo">EpedA</a>
      </ul>
    </nav>

    <center>
          <div class="wrapper">
            <div class="form">
          <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="oldimage">
            <div class="input_field">
              <label>Image</label>
              <input type="file" name="profileImg" class="input">
            </div>
            <div class="submit_field">
              <input type="submit" value="Change Image" class="btn" name="update-prof-img-btn">
            </div>
          </form>
        </div>
      </div>
    </center>
  </body>
</body>
</html>
