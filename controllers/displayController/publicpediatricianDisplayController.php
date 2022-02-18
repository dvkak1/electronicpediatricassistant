<?php

include "../config/db.php";

$firstName = "";
$lastName = "";
$contactNo = "";
$serviceID = "";
$specialization = "";
$serviceType = "";
$hospAf = "";

if (isset($_GET['id'])){
  $pediaID = $_GET['id'];

  $sql = "SELECT pediatrician.*, specialization.*, services.*, pediaservice.*,
          hospitalaffiliation.*, pedia_hosp.* FROM pediatrician
          INNER JOIN specialization
          ON pediatrician.specializationID = specialization.specializationID
          INNER JOIN pediaservice ON pediaservice.pediaID = pediatrician.pediaID
          INNER JOIN services ON services.serviceID = pediaservice.serviceID
          INNER JOIN pedia_hosp ON pedia_hosp.pediaID = pediatrician.pediaID
          INNER JOIN hospitalaffiliation ON pedia_hosp.hospAfID = hospitalaffiliation.hospAfID
          WHERE pediatrician.pediaID = ?
          AND pediatrician.specializationID = specialization.specializationID
          LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $pediaID);
  $stmt->execute();
  $results = $stmt->get_result();
  $rows = $results->fetch_assoc();

  $firstName = $rows['pedFirstName'];
  $lastName = $rows['pedLastName'];
  $specialization = $rows['specialization_name'];
  $services = $rows['serviceType'];
  $contactNo = $rows['mobileNo'];
  $hospAf = $rows['hospitalName'];
}

?>
