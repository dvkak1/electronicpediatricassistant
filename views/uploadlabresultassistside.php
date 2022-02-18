<?php

include "../controllers/labResultController/uploadLabController.php";

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" display="width-device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper,min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
<title>EpedA - Electronic Pediatric Assistant</title>
</head>
<body>
  <header>
    <header>
      <div class="logo">
        <h1 class="logo-text"><a href="index.php">E<span>ped</span>A</a></h1>
      </div>
      <ul class="nav">
        <li><a href="patientmedicalrecordsdrasstview.php">Medical Records</a></li>
        <li><a href="#">Government Links</a></li>
        <li><a href="uploadlabresultassistside.php">Upload Laboratory Result</a></li>
        <li><a href="assist_message.php">Message</a></li>
        <li><a href="../index.php?logout=1">Log out</a></li>
      </ul>
    </header>

  <center>
   <div class="form-wrapper">
     <div class="content clearfix">
         <div class="auth-content">
           <div class="form-title">
             <h2>Upload Laboratory Result</h2>
           </div>
           <form action="uploadlabresultassistside.php" method="POST" enctype="multipart/form-data">
             <input type="file" name="labResult" class="text-input"><br>
             <input type="text" name="labPatFN" class="text-input" placeholder="First Name of patient"><br>
             <input type="text" name="labPatLN" class="text-input" placeholder="Last Name of patient"><br>
             <input type="text" name="labCategory" class="text-input" placeholder="Lab Test Category"><br>
             <input type="submit" name="lab-result" value="Upload Lab Result" class="btn">
           </form>
         </div>
     </div>
   </div>
 </center>

</body>
</html>
