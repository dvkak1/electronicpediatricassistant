<?php

require_once "../controllers/pedProfInformControllers/profileController.php"

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
          <li><a href="message.php">Message</a></li>
        </ul>
      </li>
      <li><a href="signin.php?logout=1">Logout</a></li>
    </ul>
  </header>


  <center>

    <div class="form-wrapper">
        <center>
      <form action="editdocprofile.php" method="POST" enctype="multipart/form-data">
      <div class="content clearfix">
        <div class="auth-content">
          <div class="form-title">
            <h2>Upload Profile Picture</h2>
          </div>
          <img src="../img/person.png" onclick="triggerClick()" id="profImageDisplay">
          <input type="file" name="profileimage" onchange="displayImage(this)" id="changeDrProfImage"  style="display:none;"><br>
          <input type="submit" name="upload-image" class="btn" value="Upload Profile Image">
          <br><br>
          <input type="submit" name="update-image" class="btn" value="Update Profile Image">
        </div>
      </div>
    </div>
  </center>
  <script src="../profimagescript.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
  integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
  crossorigin="anonymous"></script>
</body>
</html>
