<?php
require_once "../controllers/displayController/displayDoctorInfo.php";
require_once "../controllers/displayController/dropdownPediatricianController.php";
require_once "../controllers/displayController/displayFooterContent.php";
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
<?php include "../templates/publicdoctorportalheader.php"?>


<center>


  <div class="page-wrapper">
    <div class="post-slider">
      <h1 class="slider-title" id="doctor-title">Welcome to Our Clinic</h1>

      <div class="profile-picture">
        <img src="<?= $pedProfImage?>" id="publicprofpic" width="150px">
      </div>

      <div class="post-wrapper" id="publicdoctorprofile">
            <div class="post" id="doctorportal">
              <div class="post-info">
                <center>
                  <h4>Doctor's Name</h4>
                  <p><?= $pedFN . " " . $pedLN ?></p>
                  <h4>Specialization </h4>
                  <p><?= $pedSpecia ?></p>
                </center>
              </div>
            </div>
            <div class="post" id="doctorportal">
              <div class="post-info">
                <center>
                <h4>Hospital Affilation</h4>
                <p> <?= $pedHospAf ?> </p>
                <h4>Contact Number</h4>
                <p><a href=""><?= $pedContNo ?></a></p>
               </center>
              </div>
            </div>
            <div class="post" id="doctorportal">
              <div class="post-info">
                <center>
                <h4>Clinic</h4>
                <p> <?= $pedClinic ?></p>
                <h4>Schedule</h4>
                <?php foreach(explode(',', $pedSchedule) AS $schedule) {
                echo "<p>". $schedule ."</p>";
                } ?>
                <!-- <p> <-?= $pedContNo ?> </p> -->
               </center>
              </div>
            </div>
            <div class="post" id="doctorportal">
              <div class="post-info">
                <center>
                <h4>Services</h4>
                <?php foreach(explode(',', $pedServices) AS $services) {
                 echo "<p>". $services . "</p>";
                }?>
                <!-- <p>Service 2</p>
                <p>Service 3</p> -->
                <!-- <p> <-?= $pedClinic ?> </p> -->
               </center>
              </div>
            </div>
    </div>
  </div>
</center>
<?php include("../templates/footer.php"); ?>
</body>
</html>
