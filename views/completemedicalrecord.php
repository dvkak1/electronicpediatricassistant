<?php
include "../controllers/CRUDController/pediatriciansideControllers/UpdateMedRecordController.php";
include "../controllers/authenticationControllers/loginController.php";
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
crossorigin="anonymous"/>
<meta name="viewport" content="width-device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
<head>
 <meta charset="utf-8">
 <title>EpedA - Electronic Pediatric Assistant</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="style.css">
 <body>
   <?php include("../templates/pvtdrportalheader.php")?>
   <center>
   <div class="form-wrapper">
     <div class="content clearfix">
       <div class="auth-content" style="width: 400px;">
       <div class="form-title">
         <h2>Medical Record for Patient <?= $patFirstNameFetch . " " . $patLastNameFetch ?></h2>
       </div>
       <form action="completemedicalrecord.php" method="POST">

         <?php if(isset($_SESSION['updateComplete'])){
           echo $_SESSION['updateComplete'];
         }unset($_SESSION['updateComplete']);
         ?>

         <?php if (count($fieldEmptyErrors) > 0):
           foreach($fieldEmptyErrors AS $fieldEmptyError):
             echo $fieldEmptyError . "<br>";
           endforeach;
         endif;
          ?>
         <input type="hidden" name="recID" value="<?= $patPatientIDFetch ?>">
         <textarea class="text-input" placeholder="Complaints" name="complaint"></textarea><br>
         <textarea class="text-input" placeholder="Duration" name="duration"></textarea><br>
         <textarea class="text-input" placeholder="Tentative Diagnosis" name="tenDx"></textarea><br>
         <textarea class="text-input" placeholder="Final Diagnosis" name="finDx"></textarea><br>
         <textarea class="text-input" placeholder="Previous Medications" name="prevMeds"></textarea><br>
         <textarea class="text-input" placeholder="Recommended Laboratory Exams" name="recLabEx"></textarea><br>
         <textarea class="text-input" placeholder="Recommended Medications" name="recMed"></textarea><br>
         <textarea class="text-input" placeholder="Dosage" name="dose"></textarea><br>
         <textarea class="text-input" placeholder="Comments" name="comments"></textarea><br>
         <textarea class="text-input" placeholder="Family History" name="famHis"></textarea><br>
         <input type="submit" class="btn" value="Submit" name="update-rec-dr">
     </div>
   </div>
   </div>
 </center>
   <?php include ("../templates/footer.php") ?>
 </body>
</head>
</html>
