<?php

require_once "../controllers/authenticationControllers/reset-password-controller.php";

if (isset($_GET['password-token'])) {
  $passwordToken = $_GET['password-token'];
  resetPassword($passwordToken);
}


?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<meta name="viewport" content="width-device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
<head>
  <meta charset="utf-8">
  <title>EpedA - Electronic Pediatric Assistant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
 <?php include("../templates/header.php")?>

   <center>
    <div class="auth-content">
      <div class="form-title">
        <h2>Reset your password</h2>
      </div>

      <form action="reset-password.php" method="POST">

        <?php if(count($errors) > 0):
          foreach($errors as $error):
            echo $error . "<br>";
          endforeach;
        endif;
          ?>
          <input type="password" name="password" placeholder="Enter New Password"class="text-input"><br>
          <input type="password" name="passwordConf" placeholder="Confirm New Password" class="text-input"><br>
          <input type="submit" value="Reset Password" class="btn" name="reset-password">
      </form>
    </div>
  </center>
   <?php include "../templates/footer.php" ?>
</body>
</html>
