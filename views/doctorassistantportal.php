<?php
require_once "../controllers/authenticationControllers/doctorAssistantLoginController.php";

if (!isset($_SESSION['doctorAssistantID'])) {
  header('location:../views/doctorassistantlogin.php');
  exit();
}

require_once "../controllers/displayController/doctorassistantportaldisplayController.php";
require_once "../controllers/displayController/displayFooterContent.php";

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
<body>
  <header>
    <div class="logo">
      <h1 class="logo-text"><a href="index.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="patientmedicalrecordsdrasstview.php">Medical Records</a></li>
      <li><a href="#">Government Links</a></li>
      <li><a href="uploadlabresultassistside.php">Upload Laboratory Result</a></li>
      <li><a href="assist_message.php">Message</a></li>
      <li><a href="../index.php?logout=1">Log out</a></li>
    </ul>
  </header>
<center>
  <h1>Welcome to the doctor assistant portal</h1>
</center>
<!-- <p>Welcome to the doctor assistant portal</p>
<a href="drassistportal.php?logout=1">Logout</a> -->
<?php include "../templates/footer.php"?>
</body>
</html>
