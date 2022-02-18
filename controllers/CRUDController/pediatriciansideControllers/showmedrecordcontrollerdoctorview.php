<?php

if(!isset($_SESSION)){
  session_start();
}

include "../config/db.php";

$sqlselectrecords = "SELECT patients.*, medicalrecord.*, pediatrician.*, province.name AS provName,
                     city.name AS ctyName, street_address.*, barangay.* FROM patients
                     INNER JOIN medicalrecord ON patients.patientsID = medicalrecord.patientsID
                     INNER JOIN pediatrician ON patients.pediaID = pediatrician.pediaID
                     INNER JOIN province ON patients.Prov_ID = province.Prov_ID
                     INNER JOIN city ON patients.cityID = city.cityID
                     INNER JOIN street_address ON patients.streetAddressID = street_address.streetAddressID
                     INNER JOIN barangay ON patients.BrgyID = barangay.BrgyID
                     WHERE medicalrecord.tentativeDx IS NULL";
$stmtselectrecords = $conn->prepare($sqlselectrecords);
$stmtselectrecords->execute();
$resultselect = $stmtselectrecords->get_result();


?>
