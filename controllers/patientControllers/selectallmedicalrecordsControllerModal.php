<?php
include "../config/db.php";

$patFirstName = "";
$patLastName = "";
$patStNo = "";
$patStName = "";
$patCtyName = "";
$patProvName = "";
$patAge = "";
$patHeight = "";
$patWeight = "";
$patTemp = "";
$patBP = "";
$patComp = "";
$patDuration = "";
$patPrevMeds = "";
$patTenDx = "";
$patRecLabEx = "";
$patFinDx = "";
$patFamilyHistory = "";
$patComments = "";


if (isset($_GET['patrec'])) {
  $patientID = $_GET['patrec'];


$sqlselectallrecords = "SELECT patients.*, medicalrecord.*, province.name AS provName, city.name AS ctyName,
                        street_address.*, barangay.* FROM patients
                        INNER JOIN medicalrecord ON patients.patientsID = medicalrecord.patientsID
                        INNER JOIN province ON patients.Prov_ID = province.Prov_ID
                        INNER JOIN city ON patients.cityID = city.cityID
                        INNER JOIN street_address on patients.streetAddressID = street_address.streetAddressID
                        INNER JOIN barangay ON patients.BrgyID = barangay.BrgyID
                        WHERE patients.patientsID = ?";
$selectallrecordsstmt = $conn->prepare($sqlselectallrecords);
$selectallrecordsstmt->bind_param("i", $patientID);
$selectallrecordsstmt->execute();
$resultrecords = $selectallrecordsstmt->get_result();
$row = $resultrecords->fetch_assoc();

$patFirstName = $row['patFirstName'];
$patLastName = $row['patLastName'];
$patStNo = $row['stNo'];
$patStName = $row['stName'];
$patCtyName = $row['ctyName'];
$patProvName = $row['provName'];
$patAge = $row['Age'];
$patHeight = $row['Height'];
$patWeight = $row['Weight'];
$patTemp = $row['Temperature'];
$patBP = $row['bloodPressure'];
$patComp = $row['complaints'];
$patDuration = $row['duration'];
$patPrevMeds = $row['previousMeds'];
$patTenDx = $row['tentativeDx'];
$patRecLabEx = $row['recommendedLabExams'];
$patFinDx = $row['finalDx'];
$patFamilyHistory = $row['famHx'];
$patComments = $row['comments'];
}

?>
