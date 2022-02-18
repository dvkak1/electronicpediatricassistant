<?php
// require_once "../controllers/authenticationControllers/loginController.php";
require_once "../controllers/pedProfInformControllers/updateProfController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
</head>
<body>
    <?php include("../templates/pvtdrportalheader.php") ?>
    <center>
      <div class="auth-content">
        <div class="form-title">
          <h2>Manage Profile Information</h2>
        </div>
        <form action="manageprofile.php" method="POST">
            <input type="hidden" name="pediaID" value="<?= $pediaIDFetch ?>">
            <label>Services</label>
            <textarea class="text-input" name="services"><?= $serviceFetch ?></textarea><br>
            <label>Schedule</label>
            <textarea class="text-input" name="schedule"><?= $scheduleFetch ?></textarea><br>
            <label>Mobile Number</label>
            <input type="text" class="text-input" name="contactNo" value="<?= $contactNoFetch?>"><br>
            <input type="submit" name="update-info" class="btn" value="Update">
        </form>
    </div>
 </center>
    <?php include("../templates/footer.php");?>
</body>
</html>
