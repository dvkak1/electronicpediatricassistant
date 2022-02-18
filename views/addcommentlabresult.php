<?php
include "../controllers/labResultController/showLabResultController.php";
include "../controllers/labResultController/addCommentDrViewController.php";
?>



<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<meta name="viewport" content="width-device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
<title>EpedA - Electronic Pediatric Assistant</title>
</head>
<body>
  <header>
    <div class="logo">
      <h1 class="logo-text"><a href="privatedoctorportal.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="govtlinks.php">Government Links</a></li>
      <li>
        <a href="patientsonvisitpedside.php">Patients on Visit</a>
      </li>
      <li>
        <!-- <div id="notifLab"><-?php echo $rowNum ?></div> -->
        <a href="#">Lab Results</a>
      </li>
      <li>
        <a href="#">Other Options</a>
        <ul>
          <li><a href="addinfoformnewdoctor.php">New Doctor?</a></li>
          <li><a href="manageprofile.php">Manage Profile</a></li>
          <li><a href="profileimageupload.php">Change Profile Image</a></li>
          <li><a href="adddoctorassistant.php">Add New Doctor Assistant</a></li>
          <li><a href="uploadlabresult.php">Upload Laboratory Result</a></li>
          <li><a href="message.php">Message</a></li>
        </ul>
      </li>
      <li><a href="signin.php?logout=1">Logout</a></li>
    </ul>
  </header>
<center>
  <div class="auth-content">
    <div class="form-title">
      <h2>Lab Result of Patient</h2>
    </div>
    <?php while($row = $resultlab->fetch_assoc()) {
      echo "<br>";
      echo "<form action='addcommentlabresult.php' method='POST'>";
      echo "<input type='hidden' name='labResID' value='". $row['labResultID']."'>";
      echo "<img src='". $row['labResult'] ."' width='300px' height='400px;'>". "<br>";
      echo "<br>";
      echo "<br>" . "<textarea class='text-input' placeholder='Add comment here...' name='lab-comment'>" .$row['comments'] . "</textarea>" . "<br>";
      echo "<br>". "<input type='submit' class='btn' name='add-comment' value='Add Comment'>". "<br>";
      echo "</form>";
    } ?>
    <br>
    </div>
  </center>
</body>
</html>
