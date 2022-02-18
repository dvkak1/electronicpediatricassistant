<?php

include "../config/db.php";
//
// $update = false;

$sfn = "";
$smn = "";
$sln = "";
$patientID = "";

$patientNo  = "";

$searchPatientID = "";
$searchFirstName = "";
$searchMiddleName = "";
$searchLastName = "";
$searchMobileNumber = "";
$searchGuardianFirstName = "";
$searchGuardianLastName = "";
$searchPedFirstName = "";
$searchPedLastName = "";
$searchAge = "";
$searchHeight = "";
$searchWeight = "";
$searchTemperature = "";
$searchBloodPressure = "";
$searchProvince = "";
$searchCity = "";
$searchBrgy = "";
$searchstNo = "";
$searchstName = "";

//Update variables
$updFirstName = "";
$updMiddleName = "";
$updLastName = "";
$updMobileNumber = "";
$updGuardianFirstName = "";
$updGuardianLastName = "";
$updPedFirstName = "";
$updPedLastName = "";
$updAge = "";
$updHeight = "";
$updWeight = "";
$updTemperature = "";
$updBloodPressure = "";
$updProvince = "";
$updCity = "";
$updBrgy = "";
$updstNo = "";
$updstName = "";

$update=false;



if(isset($_GET['patNo'])) {
  $patientNo = $_GET['patNo'];

  $sqlsearchrecord = "SELECT patients.*, medicalrecord.*, pediatrician.*, province.name AS provName,
                        city.name AS ctyName, street_address.*, barangay.* FROM patients INNER JOIN
                         medicalrecord ON patients.patientsID = medicalrecord.patientsID
                         INNER JOIN pediatrician ON patients.pediaID = pediatrician.pediaID
                         INNER JOIN province ON patients.Prov_ID = province.Prov_ID
                         INNER JOIN city ON patients.cityID = city.cityID
                         INNER JOIN street_address ON patients.streetAddressID = street_address.streetAddressID
                         INNER JOIN barangay ON patients.BrgyID = barangay.BrgyID
                         WHERE patients.patientsID = ?";
  $stmtrecordsearch = $conn->prepare($sqlsearchrecord);
  $stmtrecordsearch->bind_param("i", $patientNo);
  $stmtrecordsearch->execute();
  $resultrecord = $stmtrecordsearch->get_result();
  $rowrecord = $resultrecord->fetch_assoc();

  // var_dump($rowrecord);
  $searchPatientID = $rowrecord['patientsID'];
  $searchFirstName = $rowrecord['patFirstName'];
  $searchMiddleName = $rowrecord['patMiddleName'];
  $searchLastName = $rowrecord['patLastName'];
  $searchMobileNumber = $rowrecord['mobileNo'];
  $searchGuardianFirstName = $rowrecord['guardianFirstName'];
  $searchGuardianLastName = $rowrecord['guardianLastName'];
  $searchPedFirstName = $rowrecord['pedFirstName'];
  $searchPedLastName = $rowrecord['pedLastName'];
  $searchAge = $rowrecord['Age'];
  $searchHeight = $rowrecord['Height'];
  $searchWeight = $rowrecord['Weight'];
  $searchBloodPressure = $rowrecord['bloodPressure'];
  $searchTemperature = $rowrecord['Temperature'];
  $searchProvince = $rowrecord['provName'];
  $searchCity = $rowrecord['ctyName'];
  $searchBrgy = $rowrecord['BrgyName'];
  $searchstNo = $rowrecord['stNo'];
  $searchstName = $rowrecord['stName'];

  $update = true;

}


if (isset($_POST['update-rec'])) {
  $patientid = $_POST['pID'];
  $updFirstName = $_POST['patFirstName'];
  $updMiddleName = $_POST['patMidName'];
  $updLastName = $_POST['patLastName'];
  $updGuardianFirstName = $_POST['guardFirstName'];
  $updGuardianLastName = $_POST['guardLastName'];
  $updPedFirstName = $_POST['drFirstName'];
  $updPedLastName  = $_POST['drLastName'];
  $updMobileNumber  = $_POST['pedMobNo'];
  $updAge = $_POST['patientAge'];
  $updHeight = $_POST['patientHeight'];
  $updWeight = $_POST['patientWeight'];
  $updBloodPressure = $_POST['patientBloodPressure'];
  $updTemperature = $_POST['patientTemp'];
  $updProvince = $_POST['patientProv'];
  $updCity = $_POST['patientCity'];
  $updBrgy = $_POST['BrgyName'];
  $updstName = $_POST['patientStAddress'];
  $updstNo = $_POST['patientStNo'];

  $updatepatientrec = "UPDATE patients INNER JOIN pediatrician ON pediatrician.pediaID = patients.pediaID
                      INNER JOIN medicalrecord ON patients.patientsID = medicalrecord.patientsID
                      SET patients.patFirstName = ?, patients.patMiddleName = ? ,
                       patients.patLastName=? , patients.mobileNo=? ,
                       patients.guardianFirstName=?, patients.guardianLastName= ?,
                       medicalrecord.Age = ? , medicalrecord.Height = ?,
                        medicalrecord.Weight = ?, medicalrecord.Temperature=?,
                        medicalrecord.bloodPressure=?
                        WHERE patients.patientsID = ?
                        AND patients.pediaID = pediatrician.pediaID";
  $stmtupdate = $conn->prepare($updatepatientrec);
  $stmtupdate->bind_param("sssssssssssi",$updFirstName, $updMiddleName, $updLastName, $updMobileNumber, $updGuardianFirstName, $updGuardianLastName,
                          $updAge, $updHeight, $updWeight, $updTemperature, $updBloodPressure,
                          $patientid);
  $stmtupdate->execute();
  // var_dump($stmtupdate);
}


?>
