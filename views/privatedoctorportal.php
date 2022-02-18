<?php

require_once "../controllers/authenticationControllers/loginController.php";
require_once "../controllers/displayController/privatepediaProfileController.php";
require_once "../controllers/notificationControllers/newLabResultController.php";
require_once "../controllers/displayController/displayFooterContent.php";
require_once "../controllers/displayController/dropdownCategoryLabResults.php";

if (!isset($_SESSION['id'])) {
  header('location:../views/signin.php');
  exit();
}

if ($_SESSION['isApprove'] == 0) {
  header('location:../views/signin.php');
  exit();
}

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
    <li><a href="patientsonvisitpedside.php">Patients on Visit</a></li>
    <li>
      <div id="notifLab"><?php echo $rowNum ?></div>
      <a href="#">Lab Results</a>
      <?php
       echo "<ul>";
       while ($row = $result->fetch_assoc()) {
        echo '<li><a href="viewlaboratoryresults.php?cat='. $row['category'] .'">'. $row['category'] . '</a></li>';
       }
      echo "</ul>";
      ?>
    </li>
    <li>
      <a href="#">Other Options</a>
      <ul>
        <li><a href="addpediainfoform.php">New Doctor?</a></li>
        <li><a href="manageprofile.php">Manage Profile</a></li>
        <li><a href="editdocprofile.php">Change Profile Image</a></li>
        <li><a href="adddoctorassistant.php">Add New Doctor Assistant</a></li>
        <li><a href="message.php">Message</a></li>
      </ul>
    </li>
    <li><a href="signin.php?logout=1">Logout</a></li>
  </ul>
</header>


<center>
    <br><br>
  <h2>Welcome, Dr. <?= $firstName . " " . $lastName?></h2>
  <p>Today is <?php echo date("m/d/Y"); ?></p>
</center>

<div class="page-wrapper">
  <div class="content clearfix">

    <div class="reminder-wrapper">
      <div class="title-reminder">
        <br><br><br>
        <h1><span>You</span> and your<span> client</span> matters...</h1>
      </div>
      <div class="list-of-reminders">
        <br>
        <center>
        <h4><li>Keep public profile accurate.</li></h4>
        <h4><li>Your services visible.</li></h4>
        <h4><li>Clinic schedule visible.</li></h4>
        <h4><li>Contact information reliable.</li></h4>
        <h4><li>Top-notch patient record.</li></h4>
      </center>
      </div>
    </div>

    <div class="sidebar">
      <div class="section search" id="specialization">
        <h2 class="section-title"><?= $spName ?></h2>
      </div>

      <div class="section topics">
        <h2 class="section-title">Your Services</h2>
        <ul>
          <li><a href="#">Covid-19 Testing</a></li>
          <li><a href="#">Walk in Clinic</a></li>
          <li><a href="#">Immunization</a></li>
          <li><a href="#">Wellness Check up</a></li>
          <li><a href="#">Physical examination</a></li>
          <li><a href="#">Minor injury care</a></li>
        </ul>
      </div>

    </div>
</div>
</div>
<?php include "../templates/footer.php"?>
</body>
</html>
