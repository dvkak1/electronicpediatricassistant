<?php
require_once "../controllers/CRUDController/doctorassistantsideController/createMedicalRecord.php";
require_once "../controllers/CRUDController/doctorassistantsideController/selectandSearchMedicalRecord.php";
require_once "../controllers/CRUDController/doctorassistantsideController/updateMedicalRecord.php";
require_once "../controllers/authenticationControllers/doctorAssistantLoginController.php";
include "../controllers/CRUDController/doctorassistantsideController/detectDeleteRecord.php";
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
    <div class="welcome-assistant">
    <h1>Welcome doctor assistant <?= $_SESSION['assistFirstName'] . " " .  $_SESSION['assistLastName'] ?></h1>
    <div class="dateforassistant">
     <p>Today is <?php echo date("m/d/Y"); ?></p>
    </div>
    </div>
<div class="form-wrapper">
  <div class="content clearfix">
    <div class="auth-content" id="drassist-form">
      <div class="form-title">
        <h2>PATIENT'S MEDICAL RECORD</h2>
      </div>
      <form action="patientmedicalrecordsdrasstview.php" method="POST">

         <?php if(isset($_SESSION['recordMessage'])){
                echo $_SESSION['recordMessage'];
              }unset($_SESSION['recordMessage']);
              ?>

        <?php if(isset($_SESSION['updateSuccess'])) {
          echo $_SESSION['updateSuccess'];
        }unset($_SESSION['updateSuccess'])?>

        <?php if(count($pErr) > 0):
            foreach($pErr AS $pR):
              echo $pR . "<br>";
            endforeach;
        endif;?>

        <input type="hidden" name="pID" value="<?= $searchPatientID ?>"><br>
        <input type="hidden" name="id" value="<?= $patients_ID ?>"><br>
        <input type="text" placeholder="Patient's First Name" name="patFirstName" class="text-input" value="<?= $searchFirstName ?>"><br>
        <input type="text" placeholder="Patient's Middle Name" name="patMidName" class="text-input" value="<?= $searchMiddleName ?>"><br>
        <input type="text" placeholder="Patient's Last Name" name="patLastName" class="text-input" value="<?= $searchLastName?>"><br>
        <select name="gender"  class="text-input">
          <option value="Gender">Gender</option>
          <option value="Male">M</option>
          <option value="Female">F</option>
        </select><br>
        <input type="text" placeholder="Mobile Number" name="pedMobNo" class="text-input" value="<?= $searchMobileNumber ?>"><br>
        <input type="text" placeholder="Guardian First Name" name="guardFirstName" class="text-input" value="<?= $searchGuardianFirstName ?>"><br>
        <input type="text" placeholder="Guardian Last Name" name="guardLastName" class="text-input" value="<?= $searchGuardianLastName ?>"><br>
        <input type="text" placeholder="Pediatrician First Name" name="drFirstName" class="text-input" value="<?= $searchPedFirstName ?>"><br>
        <input type="text" placeholder="Pediatrician Last Name" name="drLastName" class="text-input" value="<?= $searchPedLastName ?>"><br>
        <input type="date" name="bdate"  class="text-input"><br>
        <input type="text" placeholder="Age" name="patientAge" class="text-input" value="<?= $searchAge ?>"><br>
        <input type="text" placeholder="Height (in)" name="patientHeight" class="text-input" value="<?= $searchHeight ?>"><br>
        <input type="text" placeholder="Weight (kilos)" name="patientWeight" class="text-input" value="<?= $searchWeight ?>"><br>
        <input type="text" placeholder="Temperature" name="patientTemp" class="text-input" value="<?= $searchTemperature ?>"><br>
        <input type="text" placeholder="Blood Pressure" name="patientBloodPressure" class="text-input" value="<?= $searchBloodPressure ?>"><br>
        <input type="text" placeholder="Province" name="patientProv" class="text-input" value="<?= $searchProvince ?>"><br>
        <input type="text" placeholder="City" name="patientCity" class="text-input" value="<?= $searchCity ?>"><br>
        <input type="text" placeholder="Barangay" name="BrgyName" class="text-input" value="<?= $searchBrgy ?>"><br>
        <input type="text" placeholder="Street Number" name="patientStNo" class="text-input" value="<?= $searchstNo ?>"><br>
        <input type="text" placeholder="Street Address" name="patientStAddress" class="text-input" value="<?= $searchstName ?>"><br>
        <?php if ($update == true) { ?>
        <input type="submit" class="btn" value="Update Medical Record" name="updateassist-rec-btn"><br><br>
        <a href="patientmedicalrecordsdrasstview.php"><input type="submit" class="btn" value="Return"></a>
        <?php } else { ?>
        <input type="submit" class="btn" value="Create Patient Record" name="create-rec">
      <?php } ?>
      </form>
   </div>
 </div>
  <div class="search-container" id="search-form">
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

</center>
</body>
</html>
