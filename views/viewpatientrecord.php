<?php
require_once "../controllers/patientControllers/selectallmedicalrecordsController.php";

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
      <h1 class="logo-text"><a href="patientportal.php">E<span>ped</span>A</a></h1>
    </div>
    <ul class="nav">
      <li><a href="viewpatientrecord.php?patrec=<?=$_SESSION['patNo']?>">View Record</a></li>
      <li><a href="uploadlabresultpatientside.php">Upload Laboratory Result</a></li>
      <li><a href="patient_message.php">Message</a></li>
      <li><a href="patientsportal.php?logout=1">Logout</a></li>
    </ul>
  </header>
<center>

  <?php while ($row = $resultrecords->fetch_assoc()) {
    echo "<div class='auth-content' style='background-color: #e6f2ff'>";
    echo  "<div class='form-title'>";
    echo   "<h2>Medical Record</h2>";
    echo  "</div>";
    echo "<p>Medical Record Number ". $row['patientsID'] . "</p>". "<br>";
    echo  "<p>Patient Name " . $row['patFirstName'] . " " . $row['patLastName']. "</p>" . "<br>";
    echo  "<p>Address " . $row['stNo'] . " " . $row['stName'] . " " . $row['ctyName'] . " " . $row['provName'] . "</p>" . "<br>";
    echo  "<p>Age " . $row['Age'] . "</p>" . "<br>";
    echo  "<p>Height " . $row['Height'] . "</p>" . "<br>";
    echo "<p>Weight " . $row['Weight'] . "</p>" ."<br>";
    echo "<p>Temperature " . $row['Temperature'] . "</p>" . "<br>";
    echo "<p>Blood Pressure " . $row['bloodPressure'] . "</p>" . "<br>";
    echo "<p>Complaints " . $row['complaints'] . "</p>". "<br>";
    echo "<p>Duration " . $row['duration'] . "</p>" . "<br>";
    echo "<p>Previous Medication " . $row['previousMeds'] . "</p>". "<br>";
    echo "<p>Tentative Diagnosis " . $row['tentativeDx'] . "</p>". "<br>";
    echo "<p>Recommended Laboratory Exams " . $row['recommendedLabExams'] . "</p>". "<br>";
    echo "<p>Final Diagnosis " . $row['finalDx'] . "</p>" ."<br>";
    echo "<p>Family History " . $row['famHx'] . "</p>" . "<br>";
    echo "<p>Comments " . $row['comments'] . "</p>" . "<br>";
    echo "</div>";
    }
  ?>
</center>
</body>
</html>
