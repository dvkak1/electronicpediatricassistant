 <?php
require_once "../controllers/CRUDController/doctorassistantsideController/createMedicalRecord.php";
require_once "../controllers/CRUDController/doctorassistantsideController/selectandSearchMedicalrecord.php";
require_once "../controllers/CRUDController/doctorassistantsideController/updateMedicalRecord.php";
require_once "../controllers/authenticationControllers/doctorAssistantLoginController.php";

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<meta name="viewport" display="width-device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper,min.js"></script>
<body>
  <nav>
    <a href="doctorassistantportal.php" class="logo">EpedA</a>
    <ul>
      <li><a href="medicalrecordsformfordoctorassistant.php">Medical Records</a></li>
      <li><a href="searchpatient.php">Search Patient</a></li>
      <li><a href="#">Government Links</a></li>
      <li><a href="assist_message.php">Message</a></li>
      <li><a href="doctorassistantportal.php?logout=1">Log out</a></li>
    </ul>
  </nav>


    <div class="assist-search-wrapper">
      <div class="assist-search-form">
        <form action="" method="POST">
          <div class="input_field">
            <input type="text" class="input" name="firstn" placeholder="First Name" value="">
          </div>
          <div class="input_field">
            <input type="text" class="input" name="midn" placeholder="Middle Name" value="">
          </div>
          <div class="input_field">
            <input type="text" class="input" name="lastn" placeholder="Last Name" value="">
          </div>
          <div class="submit_field">
            <input type="submit" class="btn" name="searchpatientassist-btn">
          </div>
        </form>
      </div>
    </div>


    <div class="assist-table-container">
      <table class="assist-content-table">
        <thead>
          <tr>
            <th>Med Record No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?= $idfetch ?></td>
            <td><?= $patFNFetch ?></td>
            <td><?= $patLNFetch ?></td>
            <td><a href="medicalrecordsformfordoctorassistant.php?comp=<?= $idfetch?>" class="view-btn">View Record</a></td>
          </tr>
        </tbody>
        </table>
      </div>


  <div class="assist-med-record-wrapper">
    <div class="assist-med-record-form">
      <div class="title">
        Doctor Assistant Create Medical Record
      </div>
      <form action="medicalrecordsformfordoctorassistant.php" method="POST">

            <?php if(isset($_SESSION['recordMessage'])){
              echo $_SESSION['recordMessage'];
            } unset($_SESSION['recordMessage']);?>

                      <?php if(count($errors) > 0):
                        foreach($errors as $error):
                          echo $error . "<br>";
                        endforeach;
                      endif;
                      ?>
        <div class="input_field">
          <label>First Name</label>
          <input type="text" class="input" name="patientFirstName" value="<?= $patFNFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Middle Name</label>
          <input type="text" class="input" name="patientMiddleName" value="<?= $patMNFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Last Name</label>
          <input type="text" class="input" name="patientLastName" value="<?= $patLNFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Mobile Number</label>
          <input type="text" class="input" name="mobileNumber" value="<?= $patMoNo_2 ?>">
        </div>
        <div class="input_field">
          <label>Guardian First Name</label>
          <input type="text" class="input" name="guardianFName" value="<?=   $patGuardianFNFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Guardian Last Name</label>
          <input type="text" class="input" name="guardianLName" value="<?= $patGuardianLNFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Age</label>
          <input type="text" class="input" name="patientAge" value="<?= $patAgeFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Height</label>
          <input type="text" class="input" name="patientHeight" value="<?= $patHeightFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Weight</label>
          <input type="text" class="input" name="patientWeight" value="<?= $patWeightFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Temperature</label>
          <input type="text" class="input" name="patientTemperature" value="<?= $patTempFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Blood Pressure</label>
          <input type="text" class="input" name="patientBP" value="<?= $patBPFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Province</label>
          <input type="text" class="input" name="patientProvince" value="<?= $patProvFetch_2?>">
        </div>
        <div class="input_field">
          <label>City</label>
          <input type="text" class="input" name="patientCity" value="<?= $patCtyFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Barangay</label>
          <input type="text" class="input" name="patBrgy" value="<?= $patBRGYFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Street Number</label>
          <input type="text" class="input" name="patStreetNo" value="<?= $patstNoFetch_2 ?>">
        </div>
        <div class="input_field">
          <label>Street Address</label>
          <input type="text" class="input" name="patStreetAdd" value="<?= $patstAddFetch_2 ?>">
        </div>
        <?php if ($update == true) {?>
        <div class="submit_field">
          <input type="submit" value="Update Medical Record" class="btn" name="updateassist-rec-btn">
        </div><br>
      <?php  } else {?>
        <div class="submit_field">
          <input type="submit" value="Create Medical Record" class="btn" name="createrecassist-btn">
        </div>
      <?php } ?>
      </form>
    </div>
  </div>
</html>
