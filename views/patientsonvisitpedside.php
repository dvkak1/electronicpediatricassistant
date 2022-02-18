<?php
require_once "../controllers/CRUDController/pediatriciansideControllers/UpdateMedRecordController.php";
require_once "../controllers/authenticationControllers/loginController.php";
require_once "../controllers/CRUDController/pediatriciansideControllers/showmedrecordcontrollerdoctorview.php";
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
        <a href="searchpatientdrview.php">Search Patient</a>
      </li>
      <li>
        <!-- <div id="notifLab"><-?php echo $rowNum ?></div> -->
        <a href="labResultList.php">Lab Results</a>
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
    <div class="welcome-doctor">
    <h1>Welcome Doctor <?= $_SESSION['pedFirstName'] . " " . $_SESSION['pedLastName'] ?></h1>
    <div class="datefordoctor">
     <p>Today is <?php echo date("m/d/Y"); ?></p>
    </div>
    </div>

  <div class="form-wrapper">
    <div class="content clearfix">
      <div class="auth-content" id="doctor-form">
        <div class="form-title">
          <h2>PATIENT'S PERSONAL INFORMATION</h2>
        </div>
        <form action="" method="POST">
          <input type="text" placeholder="Patient's First Name" name="patientFirstName" class="text-input" value="<?= $patFirstNameFetch ?>"><br>
          <input type="text" placeholder="Patient's Middle Name" name="patientMiddleName" class="text-input" value="<?= $patMiddleNameFetch ?>"><br>
          <input type="text" placeholder="Patient's Last Name" name="patientLastName" class="text-input" value="<?= $patLastNameFetch ?>"><br>
          <input type="text" placeholder="Mobile Number" name="mobileNo" class="text-input" value="<?= $patMobileNoFetch ?>"><br>
          <input type="text" placeholder="Guardian First Name" name="guardianFName" class="text-input" value="<?= $patGuardFirstNameFetch ?>"><br>
          <input type="text" placeholder="Guardian Last Name" name="guardianLName" class="text-input" value="<?= $patGuardLastNameFetch ?>"><br>
          <input type="text" placeholder="Age" name="patientAge" class="text-input" value="<?= $patAgeFetch ?>"><br>
          <input type="text" placeholder="Height" name="patientHeight" class="text-input" value="<?= $patHeightFetch ?>"><br>
          <input type="text" placeholder="Weight" name="patientWeight" class="text-input" value="<?= $patWeightFetch ?>"><br>
          <input type="text" placeholder="Temperature" name="patientTemperature" class="text-input" value="<?= $patTempFetch ?>"><br>
          <input type="text" placeholder="Blood Pressure" name="patientBP" class="text-input" value="<?= $patBloodPressureFetch?>"><br>
          <input type="text" placeholder="Province" name="patientProvince" class="text-input" value="<?= $patProvFetch ?>"><br>
          <input type="text" placeholder="City" name="patientCity" class="text-input" value="<?= $patCityFetch ?>"><br>
          <input type="text" placeholder="Barangay" name="patBrgy" class="text-input" value="<?= $patBrgyFetch ?>"><br>
          <input type="text" placeholder="Street Number" name="patStreetNo" class="text-input" value="<?= $patStNoFetch ?>"><br>
          <input type="text" placeholder="Street Address" name="patStreetAdd" class="text-input" value="<?= $patStNameFetch ?>"><br>

          <?php if ($update == true) { ?>
          <a href="completemedicalrecord.php?patientID=<?= $patPatientIDFetch ?>" class="btn">Update Medical Record</a>
          <?php } else { ?>

          <?php } ?>
        </form>
      </div>


    <table class="doctor-content-table">
    <thead>
      <tr>
        <th>Med Record No</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($rowselect = $resultselect->fetch_assoc()) { ?>
      <tr>
        <td><?= $rowselect['medRecordID']?></td>
        <td><?= $rowselect['patFirstName']?></td>
        <td><?= $rowselect['patLastName']?></td>
        <td><a href="patientsonvisitpedside.php?recno=<?= $rowselect['patientsID']?>"><input type="submit" class="btn" value="View Record"></a></td>
      </tr>
      <?php } ?>
    </tbody>
    </table>

  </div>
  </div>
</center>

</body>
</html>
