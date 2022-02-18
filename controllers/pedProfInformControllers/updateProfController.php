<?php

if (!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";
require_once "../controllers/authenticationControllers/loginController.php";

$serviceFetch = "";
$provinceFetch = "";
$cityFetch = "";
$streetAddressFetch = "";
$streetNumberFetch = "";
$clinicFetch = "";
$brgyFetch = "";
$pediaIDFetch = "";
$contactNoFetch = "";

$pediaIDQuery  = $_SESSION['id'];


$serviceUpd = "";
$scheduleUpd = "";
$pediaIDUpd = "";

$sqlfetchPersonInfo = "SELECT pediatrician.*, clinicpedia.*, barangay.*, clinic.*, services.*, pediaservice.*, clinicpedschedule.*, street_address.*,
                       city.name AS ctName, province.Prov_ID, province.name AS prvName
                       FROM pediatrician INNER JOIN clinicpedia ON clinicpedia.pediaID = pediatrician.pediaID
                       INNER JOIN clinic ON clinicpedia.clinicID = clinic.clinicID
                       INNER JOIN pediaservice ON pediaservice.pediaID = pediatrician.pediaID
                       INNER JOIN services ON services.serviceID = pediaservice.serviceID
                       INNER JOIN clinicpedschedule ON clinicpedschedule.pediaID = pediatrician.pediaID
                       INNER JOIN street_address ON street_address.streetAddressID = clinic.streetAddressID
                       INNER JOIN city ON city.cityID = street_address.cityID
                       INNER JOIN province ON province.Prov_ID = city.Prov_ID
                       INNER JOIN barangay ON barangay.cityID = city.cityID
                       WHERE pediatrician.pediaID = ?";
$stmtfetchPersonInfo = $conn->prepare($sqlfetchPersonInfo);
$stmtfetchPersonInfo->bind_param("i", $pediaIDQuery);
$stmtfetchPersonInfo->execute();
$result = $stmtfetchPersonInfo->get_result();
$rowPedFetch = $result->fetch_assoc();

$contactNoFetch = $rowPedFetch['mobileNo'];
$provinceFetch = $rowPedFetch['prvName'];
$cityFetch = $rowPedFetch['ctName'];
$streetAddressFetch = $rowPedFetch['stName'];
$streetNumberFetch = $rowPedFetch['stNo'];
$clinicFetch = $rowPedFetch['name'];
$pediaIDFetch = $rowPedFetch['pediaID'];
$serviceFetch = $rowPedFetch['serviceType'];
$scheduleFetch = $rowPedFetch['schedule'];
$brgyFetch = $rowPedFetch['BrgyName'];

if(isset($_POST['update-info'])) {
$serviceUpd = $_POST['services'];
$scheduleUpd = $_POST['schedule'];
$contactNoUpd = $_POST['contactNo'];
$pediaIDUpd = $_POST['pediaID'];


$sqlupdateinfo = "UPDATE services INNER JOIN pediaservice ON services.serviceID = pediaservice.serviceID
                  INNER JOIN clinicpedschedule ON clinicpedschedule.pediaID = pediaservice.pediaID
                  INNER JOIN pediatrician ON pediaservice.pediaID = pediatrician.pediaID
                  SET services.serviceType=?,
                  clinicpedschedule.schedule= ?,
                  pediatrician.mobileNo = ?
                  WHERE pediaservice.pediaID = ? AND
                  clinicpedschedule.pediaID = ? AND
                  pediatrician.pediaID=?";
$stmtupdateinfo = $conn->prepare($sqlupdateinfo);
$stmtupdateinfo->bind_param("sssiii", $serviceUpd, $scheduleUpd,  $contactNoUpd, $pediaIDUpd, $pediaIDUpd, $pediaIDUpd);
$stmtupdateinfo->execute();
// var_dump($stmtupdateinfo);

}


?>
