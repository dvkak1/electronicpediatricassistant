<?php include "labResnotificationController.php"?>

<header>
  <div class="logo">
    <h1 class="logo-text"><a href="doctorportalpvtver.php">E<span>ped</span>A</a></h1>
  </div>
  <ul class="nav">
    <li><a href="govtlinks.php">Government Links</a></li>
    <li>
      <a href="patientsonvisit.php">Patients on Visit</a>
      <!-- <ul>
        <li><a href="createnewmedrecorddrview.php">Create Medical Record</a></li>
      </ul> -->
    </li>
    <li>
      <div id="notifLab"><?php echo $rowNum ?></div>
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
    <li>
      <a href="#">Search</a>
      <ul>
        <li><a href="searchmedrecord.php">Search Medical Record Form</a></li>
      </ul>
    </li>
    <li><a href="login.php?logout=1">Logout</a></li>
  </ul>
</header>
