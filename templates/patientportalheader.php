<?php
require_once "../controllers/authenticationControllers/signinaspatientController.php";
?>


<header>
  <div class="logo">
    <h1 class="logo-text"><a href="patientportal.php">E<span>ped</span>A</a></h1>
  </div>
  <ul class="nav">
    <li><a href="viewmedicalrecordpatientside.php?patrec=<?=$_SESSION['patientno']?>">View Record</a></li>
    <li><a href="uploadlabresultpatientside.php">Upload Laboratory Result</a></li>
    <li><a href="patient_message.php">Message</a></li>
    <li><a href="patientsportal.php?logout=1">Logout</a></li>
  </ul>
</header>
