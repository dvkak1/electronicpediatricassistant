<?php

include "../config/db.php";


$fileLabResult = "";
$fileLabResultTmp = "";
$labResultPatFirstName = "";
$labResultPatLastName = "";
$isSeen = 0;
$category = "";
// $labComments = "";
// $patientID = "";

if (isset($_POST['lab-result'])) {

  $labResultPatFirstName = $_POST['labPatFN'];
  $labResultPatLastName = $_POST['labPatLN'];
  $fileLabResult = time() . '_' . $_FILES['labResult']['name'];
  $fileLabResultTmp = $_FILES['labResult']['tmp_name'];
  $category = $_POST['labCategory'];

  $targetFolder = "../labresults/" .  $fileLabResult;



  if (move_uploaded_file($fileLabResultTmp, $targetFolder)) {

    $sqlselectpatient = "SELECT patientsID FROM patients WHERE patFirstName=? AND patLastName=?";
    $stmtselectpatient = $conn->prepare($sqlselectpatient);
    $stmtselectpatient->bind_param("ss", $labResultPatFirstName, $labResultPatLastName);
    $stmtselectpatient->execute();
    $result = $stmtselectpatient->get_result();
    $row = $result->fetch_assoc();

    $patientID = $row['patientsID'];

    $sqlinsertlab = "INSERT INTO laboratoryresults(patientsID, labResult, isSeen, category) VALUES(?, ?, ?, ?)";
    $stmtinsertlab = $conn->prepare($sqlinsertlab);
    $stmtinsertlab->bind_param("isis", $patientID, $targetFolder, $isSeen, $category);

    if ($stmtinsertlab->execute()) {
      echo "Upload successful";
    } else {
    echo "Failed to upload";
   }


}
}


?>
