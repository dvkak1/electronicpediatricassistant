<?php

include "../config/db.php";
include "../controllers/functionsFolder/functions.php";

$searchPediatricians = "";

$showAllLocations = "";

$selectSpecializations = "";

$searchLogs = array();

if (isset($_GET['spec'])) {
  $selectSpecializations = selectOne('specialization', ['specializationID' => $_GET['spec']]);

  foreach($selectSpecializations AS $selectSpecialization) {
    $specID = $selectSpecialization['specializationID'];
    $specShow = $selectSpecialization['specialization_name'];
  }
}

$showAllLocations = showAllLocations(['specializationID' => $specID]);


if(isset($_GET['prvID']) && isset($_GET['specID2'])) {
  $fetchDatas = fetchLocationAndSpecialization(['Prov_ID' => $_GET['prvID'],
                                                'specializationID' => $_GET['specID2']]);
}



$showAllLocations = showAllLocations(['specializationID' => $specID]);


if (isset($_POST['search-ped-btn'])) {
  $searchLogs = "%{$_POST['search-term']}%";
  $searchSpecID =  $_POST['spec-ID'];

}


$sql = "SELECT pediatrician.*, specialization.*, clinicpedia.*, clinic.*,street_address.*,
          city.name AS ctName,
          province.name AS prvName FROM pediatrician INNER JOIN specialization
          ON pediatrician.specializationID = specialization.specializationID
          INNER JOIN clinicpedia ON clinicpedia.pediaID = pediatrician.pediaID
          INNER JOIN clinic ON clinicpedia.clinicID = clinic.clinicID
          INNER JOIN street_address ON street_address.streetAddressID = clinic.streetAddressID
          INNER JOIN city ON city.cityID = street_address.cityID
          INNER JOIN province ON province.Prov_ID = city.Prov_ID
          WHERE province.name LIKE ?
          OR street_address.stName LIKE ?
          OR city.name LIKE ?
          AND specialization.specializationID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $searchLogs, $searchLogs, $searchLogs, $searchSpecID);
$stmt->execute();
$resultsearch = $stmt->get_result();

?>
