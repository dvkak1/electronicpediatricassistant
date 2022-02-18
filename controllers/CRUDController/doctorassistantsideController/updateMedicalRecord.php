<?php

error_reporting (E_ALL ^ E_NOTICE);

if (!isset($_SESSION)) {
  session_start();
}


include "../config/db.php";
//
// include "../controllers/functionsFolder/functions.php";
//
// include "../inputValidators/validateInputs.php";

$patients_ID = "";

//Declared variables for updating of data
$patients_ID = $_GET['patNo'];

$patFNUpdate = "";
$patMNUpdate = "";
$patLNUpdate = "";
$patguFNUpdate = "";
$patgLNUpdate = "";
$patAgeUpdate = "";
$patMoNoUpdate = "";
$patBPUpdate = "";
$patTempUpdate = "";
$patHeightUpdate = "";
$patWeightUpdate = "";
$patProvinceUpdate = "";
$patCityUpdate = "";
$patstrAddUpdate = "";
$patstrNoUpdate = "";

$patientID = "";

$pErr = array();

if (isset($_POST['updateassist-rec-btn'])){

  $patientID = $_POST['id'];
  $patFirstNameUpdate = $_POST['patFirstName'];
  $patMiddleNameUpdate =  $_POST['patMidName'];
  $patLastNameUpdate = $_POST['patLastName'];
  $patMoNoUpdate = $_POST['mobileNumber'];
  $patguardianFNUpdate =  $_POST['guardFirstName'];
  $patguardianLNUpdate =$_POST['guardLastName'];
  $patProvinceUpdate = $_POST['patientProv'];
  $patCityUpdate = $_POST['patientCity'];
  $patstrAddUpdate = $_POST['patientStAddress'];
  $patstrNoUpdate = $_POST['patientStNo'];
  $patientBrgyUpdate = $_POST['BrgyName'];
  $patAgeUpdate = $_POST['patientAge'];
  $patTempUpdate = $_POST['patientTemperature'];
  $patBPUpdate = $_POST['patientBP'];
  $patHeightUpdate = $_POST['patientHeight'];
  $patWeightUpdate = $_POST['patientWeight'];

  // if (empty($patFirstNameUpdate)) {
  //   $pErr['patientFirstName'] = "Please enter your first name";
  // }
  // if (empty($patMiddleNameUpdate)) {
  //   $pErr['patientMiddleName'] = "Please enter your middle name";
  // }
  // if (empty($patLastNameUpdate)) {
  //   $pErr['patientLastName'] = "Please enter your last name";
  // }
  // if (empty($patMoNoUpdate)) {
  //   $pErr['mobileNumber'] = "Please enter your last name";
  // }
  // if (empty($patguardianFNUpdate)) {
  //   $pErr['guardianFName'] = "Please enter your guardian's first name";
  // }
  // if (empty($patguardianLNUpdate)) {
  //   $pErr['guardianFName'] = "Please enter your last name";
  // }
  // if (empty($patProvinceUpdate)) {
  //   $pErr['patientProvince'] = "Please enter your last name";
  // }
  // if (empty($patstrAddUpdate)) {
  //   $pErr['patStreetAdd'] = "Please enter your last name";
  // }
  // if (empty($patstrNoUpdate)) {
  //   $pErr['patientStreetNo'] = "Please enter your last name";
  // }


  $sql_update_entire = "UPDATE patients p INNER JOIN medicalrecord mr ON p.patientsID = mr.patientsID
       INNER JOIN province prov ON p.Prov_ID = prov.Prov_ID
       INNER JOIN city ct ON p.cityID = ct.cityID
       INNER JOIN street_address stAdd ON p.streetAddressID = stAdd.streetAddressID
       INNER JOIN barangay Brgy ON p.BrgyID = Brgy.BrgyID
       SET p.patFirstName = ?,
       p.patMiddleName = ?,
       p.patLastName = ?,
       p.mobileNo = ?,
       p.guardianFirstName= ?,
       p.guardianLastName = ?,
       mr.Age = ?,
       mr.Height =  ?,
       mr.Weight= ? ,
       mr.Temperature = ?,
       mr.bloodPressure = ?,
       prov.name= ?,
       ct.name= ?,
       stAdd.stName= ?,
       stAdd.stNo= ?,
       Brgy.BrgyName= ?
       WHERE p.patientsID = ?";
  $stmt_update_entire = $conn->prepare($sql_update_entire);
  $stmt_update_entire->bind_param("ssssssssssssssssi", $patFirstNameUpdate, $patMiddleNameUpdate,
                                   $patLastNameUpdate,  $patMoNoUpdate, $patguardianFNUpdate,
                                   $patguardianLNUpdate, $patAgeUpdate, $patHeightUpdate,
                                   $patWeightUpdate, $patTempUpdate, $patBPUpdate,
                                   $patProvinceUpdate, $patCityUpdate, $patstrAddUpdate,
                                   $patstrNoUpdate, $patientBrgyUpdate,
                                   $patientID);
echo "<pre>", print_r($stmt_update_entire), "</pre>";

  if ($stmt_update_entire->execute()) {
    $_SESSION['updateSuccess'] = "Record successfully updated";
  }



}




?>
