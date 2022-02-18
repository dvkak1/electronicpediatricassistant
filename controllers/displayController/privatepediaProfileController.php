<?php

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

$firstName = "";
$lastName = "";
$specialization = "";
$service = "";

  $pediaID = $_SESSION['id'];
  $sql_display = "SELECT pediatrician.pedFirstName, pediatrician.pedLastName, specialization.*
                  -- pedia_profile.prof_image,
                  -- services.serviceType
                  FROM specialization
                  INNER JOIN pediatrician ON specialization.specializationID = pediatrician.specializationID
                  -- INNER JOIN pedia_profile ON pedia_profile.pediaID = pediatrician.pediaID
                  -- INNER JOIN pediaservice ON pediatrician.pediaID = pediaservice.pediaID
                  -- INNER JOIN services ON services.serviceID = pediaservice.serviceID
                  WHERE pediatrician.pediaID = ?";
  $stmt_display = $conn->prepare($sql_display);
  $stmt_display->bind_param("i", $pediaID);
  $stmt_display->execute();
  $results = $stmt_display->get_result();
  $output = $results->fetch_assoc();


  $firstName = $output['pedFirstName'];
  $lastName =  $output['pedLastName'];
  $spName = $output['specialization_name'];
  // $services = $output['serviceType'];
  // $image = $output['prof_image'];



?>
