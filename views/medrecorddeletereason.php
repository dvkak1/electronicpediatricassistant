<?php
require_once "../controllers/CRUDController/doctorassistantsideController/deleteMedRecordController.php"
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
   <header>
     <div class="logo">
       <h1 class="logo-text"><a href="index.php">E<span>ped</span>A</a></h1>
     </div>
     <ul class="nav">
       <li><a href="patientmedicalrecordsdrasstview.php">Medical Records</a></li>
       <li><a href="govtlinks.php">Government Links</a></li>
       <li><a href="messageAssistView.php">Message</a></li>
       <li><a href="../index.php?logout=1">Log out</a></li>
     </ul>
   </header>
   <center>
   <div class="form-wrapper">
     <div class="content clearfix">
       <div class="auth-content" style="width: 400px;">
       <div class="form-title">
         <h2>Please enter your reason on why you are deleting this record</h2>
       </div>
       <form action="medrecorddeletereason.php" method="POST">
         <input type="hidden" name="recID" value="<?= $recNoDelete?>"><br>
         <textarea class="text-input" placeholder="Reason for deletion" name="deletereason"></textarea><br>
         <input type="submit" class="btn" value="Submit" name="enter-reason">
     </div>
   </div>
   </div>
 </center>
   <?php include ("../templates/footer.php") ?>
 </body>
</head>
</html>
