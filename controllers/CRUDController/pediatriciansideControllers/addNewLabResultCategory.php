<?php

include "../config/db.php";

$newLabCategory = "";
$labResultPatFirstName = "";
$labResultPatLastName = "";
$patientID = "";



if (isset($_POST['lab-category'])) {
  $newLabCategory = $_POST['labCategory'];
  $labResultPatFirstName = $_POST['labPatFN'];
  $labResultPatLastName = $_POST['labPatLN'];

  $sqlselectpatient = "SELECT patientsID FROM patients WHERE patFirstName=? AND patLastName=?";
  $stmtselectpatient = $conn->prepare($sqlselectpatient);
  $stmtselectpatient->bind_param("ss", $labResultPatFirstName, $labResultPatLastName);
  $stmtselectpatient->execute();
  $result = $stmtselectpatient->get_result();
  $row = $result->fetch_assoc();


  $patientID = $row['patientsID'];

  $sqlLabCategory = "INSERT INTO laboratoryresults(patientsID, category) VALUES (?, ?)";
  $stmtlabCat = $conn->prepare($sqlLabCategory);
  $stmtlabCat->bind_param("is", $patientID, $newLabCategory);
  $stmtlabCat->execute();
}



?>
