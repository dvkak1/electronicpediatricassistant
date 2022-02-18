<?php

if (!isset($_SESSION)){
  session_start();
}


include "../config/db.php";
//
// $spName = "";
// $ctName = "";
// $stN = "";
// $stNa = "";
// $clN = "";
// $specID = "";
// $specName = "";
// $pedFN = "";
// $pedLN = "";
// $provn = "";

if (isset($_GET['specialization'])) {
  $getSpec  =  $_GET['specialization'];


  $sql_find_pediatrician = "SELECT province.name AS provn, city.name AS citn,
  street_address.*, clinic.name AS clName, pediatrician.*, specialization.*
  FROM province INNER JOIN city ON province.Prov_ID = city.Prov_ID
  INNER JOIN street_address ON street_address.cityID = city.cityID
  INNER JOIN clinic ON clinic.streetAddressID = street_address.streetAddressID
  INNER JOIN clinicpedia ON clinicpedia.clinicID = clinic.clinicID
  INNER JOIN pediatrician ON pediatrician.pediaID = clinicpedia.pediaID
  INNER JOIN specialization ON specialization.specializationID = pediatrician.specializationID
  WHERE specialization.specializationID = ?";
  $stmt_find_pediatrician = $conn->prepare($sql_find_pediatrician);
  $stmt_find_pediatrician->bind_param("i", $getSpec);
  $stmt_find_pediatrician->execute();
  $result = $stmt_find_pediatrician->get_result();


 }
?>
