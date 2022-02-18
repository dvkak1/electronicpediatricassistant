<?php

require_once "../controllers/authenticationControllers/loginController.php";
require_once "../controllers/patientControllers/selectallmedicalrecordsControllerModal.php";

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" display="width-device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper,min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
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
  <div class="form-wrapper">
    <div class="content clearfix">
      <div class="auth-content" id="doctor-form">
        <div class="form-title">
          <h2>SEARCH PATIENT</h2>
        </div>
        <form action="searchpatientdrview.php" method="POST">
          <input type="text" placeholder="Patient's First Name" name="patFirstName" class="text-input"><br>
          <input type="text" placeholder="Patient's Middle Name" name="patMiddleName" class="text-input"><br>
          <input type="text" placeholder="Patient's Last Name" name="patLastName" class="text-input"><br>
          <input type="submit" value="Search" name="search-medrec-btn" class="btn">
        </form>
  </div>
  <?php
  include "../controllers/CRUDController/doctorassistantsideController/searchExistingRecord.php";
  if(!isset($_POST['search-medrec-btn'])) {
     echo "";
   } else {
     echo "<table class='doctor-content-table' style='margin-right: -44px;'>";
     echo "<thead>";
     echo "<tr>";
     echo "<th>Med Rec No</th>";
     echo "<th>F Name</th>";
     echo "<th>L Name</th>";
     echo "<th>Date Seen</th>";
     echo "<th colspan='3'>Action</th>";
     echo  "</tr>";
     echo "</thead>";
    // while ($searchRec = $resultsearch->fetch_assoc()) {
    if (isset($searchRecs)) {
       foreach($searchRecs AS $searchRec) {
         echo "<tbody>";
         echo  "<tr>";
         echo "<td>" . $searchRec['medRecordID']  . "</td>";
         echo "<td>" . $searchRec['patFirstName'] ."</td>";
         echo "<td>" . $searchRec['patLastName']  . "</td>";
         echo "<td>" . $searchRec['dateSeen'] . "</td>";
         // echo '<td><a href="viewpatientrecorddrasstside.php?patrec='. $searchRec['patientsID'].'" onclick="document.getElementById("medrecordModal").style.display="block">'. "View" . "</a>" .'</td>';
         echo '<td><a href="searchpatientdrview.php?patrec='. $searchRec['patientsID'].'" onclick="document.getElementById(\'userModal\').style.display="block">'. "View" . "</a>" .'</td>';
         echo "</tbody>";
      }
    }
  }
  ?>
</div>
</center>

<div id="userModal">
  <center>
  <span onclick="document.getElementById('userModal').style.display='none'">&times;</span>
  <div class="modalContent">
     <p>Patient Name  <?= $patFirstName . " " . $patLastName ?> </p>
     <p>Address <?= $patStNo . " " . $patStName . " " . $patCtyName . " " . $patProvName ?> </p>
     <p>Age <?= $patAge ?> </p>
     <p>Height <?= $patHeight ?> </p>
     <p>Weight <?= $patWeight ?> </p>
     <p>Temperature <?= $patTemp ?> </p>
     <p>Blood Pressure  <?= $patBP ?> </p>
     <p>Complaints <?= $patComp ?> </p>
     <p>Duration  <?= $patDuration ?> </p>
     <p>Previous Medication  <?= $patPrevMeds ?> </p>
     <p>Tentative Diagnosis  <?= $patTenDx ?> </p>
     <p>Recommended Laboratory Exams  <?= $patRecLabEx ?> </p>
     <p>Final Diagnosis  <?= $patFinDx ?> </p>
     <p>Family History  <?= $patFamilyHistory ?> </p>
     <p>Comments  <?= $patComments ?> </p>
    </div>
  </div>
  </center>
  <br><br><br>
</body>
</html>
