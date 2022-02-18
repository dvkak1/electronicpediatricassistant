<?php
include "../controllers/labResultController/showLabResultControllerTable.php";
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
</head>
<body>
  <header>
    <div class="logo">
      <h1 class="logo-text"><a href="privatedoctorportal.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="govtlinks.php">Government Links</a></li>
      <li><a href="patientsonvisitpedside.php">Patients on Visit</a></li>
      <li>
        <!-- <div id="notifLab"><-?php echo $rowNum ?></div> -->
        <a href="labResultList.php">Lab Results</a>
        <ul>
          <li><a href="viewlaboratoryresults.php">CBC Count</a></li>
          <li><a href="viewlaboratoryresults.php">Urinalysis</a></li>
          <li><a href="viewlaboratoryresults.php">X-Ray</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Other Options</a>
        <ul>
          <li><a href="addpediainfoform.php">New Doctor?</a></li>
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
  <div class="list-content">
    <div class="content">
      <h2>Laboratory Results</h2>
      <table>
        <thead>
          <th>Lab Result Number</th>
          <th>File</th>
          <th>Date Uploaded</th>
          <th>Patient Name</th>
          <th colspan="3">Action</th>
        </thead>
        <tbody>
          <?php
          while ($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row['labResultID']. "</td>";
            echo "<td>".  $row['labResult'] . "</td>";
            echo "<td>".$row['patFirstName'] . " " . $row['patLastName'] ."</td>";
            // echo '<td><a href="viewlaboratoryresults.php?labID='.$row['labResultID'] .'" onclick="document.getElementById(\'userModal\').style.display="block">View Lab Result</a></td>';
            echo '<td><a href="viewlaboratoryresults.php?labID='.$row['labResultID'] .'">View Lab Result</a></td>';
            echo '<td><a href="addcommentlabresult.php?labID='. $row['labResultID'] .'">Add Comment</a></td>';
            echo "</tr>";
          }
          ?>
        </tbody>
      </div>
    </div>
  </center>
</body>
</html>
