<?php

include "../config/db.php";

if (isset($_GET['patrec'])) {
  $patientID = $_GET['patrec'];
}

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


?>
