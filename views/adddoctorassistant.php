<?php
require_once "../controllers/doctorAssistantControllers/addDrAssistantController.php";
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
<body>

<?php include "../templates/pvtdrportalheader.php" ?>

<div class="auth-content">
  <div class="form-title">
    <h2>Add Doctor Assistant</h2>
  </div>
  <center>
    <?php if (isset($_SESSION['assistMessage'])){
      echo $_SESSION['assistMessage'];
    }unset($_SESSION['assistMessage']);
    ?>
    <?php if(count($inputErrors) > 0):
      foreach($inputErrors as $inputError):
        echo $inputError . "<br>";
      endforeach;
    endif;
      ?>
   <form action="adddoctorassistant.php" method="POST">

     <input type="text" name="assistFirstName" placeholder="Assistant First Name"value="" class="text-input"><br>
     <input type="text" name="assistMiddleName" placeholder ="Assistant Middle Name" value="" class="text-input"><br>
     <input type="text" name="assistLastName" placeholder="Assistant Last Name" value="" class="text-input"><br>
     <input type="date" name="bdate" class="text-input"><br>
     <input type="text" name="mobileNo" placeholder="Mobile Number" value="" class="text-input"><br>
     <input type="text" name="username" placeholder="Username" value="" class="text-input"><br>
     <input type="password" name="passcode" placeholder="Passcode" value="" class="text-input"><br>
     <input type="password" name="passcodeConf" placeholder="Confirm Passcode" value="" class="text-input"><br>
     <input type="text" name="pedFirstName" placeholder="Pediatrician First Name" value="" class="text-input"><br>
     <input type="text" name="pedLastName" placeholder="Pediatrician Last Name" value="" class="text-input"><br>
     <input type="text" name="clinicName" placeholder="Clinic Name" value="" class="text-input"><br>
     <input type="submit" name="addassist-btn" class="btn" value="Add Doctor Assistant">
   </form>
  </center>
</div>
</body>
</html>
