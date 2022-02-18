<?php
require_once "../controllers/pedProfInformControllers/newPediaInfoController.php";
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
      <h1 class="logo-text"><a href="privatedoctorportal.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="govtlinks.php">Government Links</a></li>
      <li>
        <a href="patientsonvisitpedside.php">Patients on Visit</a>
        <!-- <ul>
          <li><a href="createnewmedrecorddrview.php">Create Medical Record</a></li>
        </ul> -->
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
          <li><a href="editdocprofile.php">Change Profile Image</a></li>
          <li><a href="adddoctorassistant.php">Add New Doctor Assistant</a></li>
          <li><a href="uploadlabresult.php">Upload Laboratory Result</a></li>
          <li><a href="message.php">Message</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Search</a>
        <ul>
          <li><a href="searchmedrecord.php">Search Medical Record Form</a></li>
        </ul>
      </li>
      <li><a href="signin.php?logout=1">Logout</a></li>
    </ul>
  </header>

  <center>
    <div class="auth-content">
      <div class="form-title">
        <h2>New Verified Doctor? Please complete this form</h2>
      </div>
    <form action="addpediainfoform.php" method="POST">

      <?php if(isset($_SESSION['infoPedia'])){
        echo $_SESSION['infoPedia'];
      }unset($_SESSION['infoPedia']);
      ?>

      <?php if(count($emptyPedErrs) > 0):
        foreach($emptyPedErrs as $error):
          echo $error . "<br>";
        endforeach;
      endif;
        ?>

      <input type="text" name="prov" value="" placeholder="Province" class="text-input"><br>
      <input type="text" name="city" value="" placeholder="City" class="text-input"><br>
      <input type="text" name="brgy" value="" placeholder="Barangay" class="text-input"><br>
      <input type="text" name="stAdd" value="" placeholder="Street Address" class="text-input"><br>
      <input type="text" name="stNo" value="" placeholder="Street Number" class="text-input"><br>
      <input type="text" name="clinic" value="" placeholder="Clinic" class="text-input"><br>
      <textarea name="services"placeholder="Enter services" class="text-input"></textarea><br>
      <input type="submit" name="add-info" class="btn" value="Add Info">
    </form>
  </div>

</center>

</body>
</html>
