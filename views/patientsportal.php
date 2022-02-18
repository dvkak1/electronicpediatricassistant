<?php

require_once "../controllers/authenticationControllers/signinaspatientController.php";

if (!isset($_SESSION['patientno'])) {
  header('location:../views/signinaspatient.php');
  // exit();
}

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
  <header>
    <div class="logo">
      <h1 class="logo-text"><a href="patientportal.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="viewpatientrecord.php?patrec=<?=$_SESSION['patientno']?>">View Record</a></li>
      <li><a href="uploadlabresultpatientside.php">Upload Laboratory Result</a></li>
      <li><a href="patient_message.php">Message</a></li>
      <li><a href="patientsportal.php?logout=1">Logout</a></li>
    </ul>
  </header>

<center>
<h1>Welcome to your patient's portal, <?= $_SESSION['patientfirstname'] . " " . $_SESSION['patientlastname']?></h1>
</center>
</body>
</html>
