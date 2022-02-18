<?php
// include      "../controllers/CRUDController/doctorassistantsideController/searchExistingRecord.php";
require_once "../controllers/patientControllers/selectallmedicalrecordsControllerModal.php";
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.gstatic.com">
<script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper,min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
<head>
  <meta charset="utf-8">
  <title>EpedA - Electronic Pediatric Assistant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<header>
  <div class="logo">
    <h1 class="logo-text"><a href="../index.php">E<span>ped</span>A</a></h1>
  </div>
  <ul class="nav">
    <li><a href="patientmedicalrecordsdrasstview.php">Medical Records</a></li>
    <li><a href="#">Government Links</a></li>
    <li><a href="messageAssistView.php">Message</a></li>
    <li><a href="../index.php?logout=1">Log out</a></li>
  </ul>
</header>
<body>
<center>
  <div class="form-wrapper">
    <div class="content clearfix">
      <div class="auth-content" id="doctor-form">
        <div class="form-title">
          <h2>SEARCH PATIENT</h2>
        </div>
        <form action="searchpatient.php" method="POST">
          <input type="text" placeholder="Patient's First Name" name="patFirstName" class="text-input"><br>
          <input type="text" placeholder="Patient's Middle Name" name="patMiddleName" class="text-input"><br>
          <input type="text" placeholder="Patient's Last Name" name="patLastName" class="text-input"><br>
          <input type="submit" value="Search" name="search-medrec-btn" class="btn">
        </form>
  </div>
</div>
<?php

include "../controllers/CRUDController/doctorassistantsideController/detectDeleteRecord.php";
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
        echo '<td><a href="searchpatient.php?patrec='. $searchRec['patientsID'].'" onclick="document.getElementById(\'userModal\').style.display="block">'. "View" . "</a>" .'</td>';
        echo '<td><a href="medrecorddeletereason.php?mrID='.$searchRec['medRecordID'].'" onclick="return confirm(\'Are you sure you want to delete this record? This cannot be undone\')";>'. "Delete" . "</a>" .'</td>';
        // echo '<td><a href="completemedicalrecord.php?recno='.$searchRec['medRecordID'].'">'. "Update" . "</a>" .'</td>';
        echo '<td><a href="patientmedicalrecordsdrasstview.php?patNo='. $searchRec['patientsID'] .'" onclick="return confirm(\'Are you sure you want to update this record? This cannot be undone\')";>'. "Update" . "</a>" .'</td>';
        echo "</tbody>";
     }
   }
     if ($result->num_rows == 1){
      echo "<p style='color:red;'>This record is deleted <p>";
     }
   }

?>
  </table>
</div>


 <div id="userModal">
   <center>
   <span onclick="document.getElementById('userModal').style.display='none'">&times;</span>
   <div class="modalContent">
      <p>Pa tient Name  <?= $patFirstName . " " . $patLastName ?> </p>
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
 </div>

</center>
</body>
</html>
