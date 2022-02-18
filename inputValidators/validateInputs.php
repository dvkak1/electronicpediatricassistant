<?php
function validateCRUDInputs($record) {
  $pErr = array();

  if (empty($record['patFirstName'])) {
    array_push($pErr, "Please input patient's first name");
  }
  if (empty($record['patMidName'])) {
    array_push($pErr, "Please input patient's middle name");
  }
  if (empty($record['patLastName'])) {
    array_push($pErr, "Please input patient's last name");
  }
  if (empty($record['pedMobNo'])) {
    array_push($pErr, "Please input patient's mobile number");
  }
  if (empty($record['guardFirstName'])) {
    array_push($pErr, "Please input first name of patient's guardian");
  }
  if (empty($record['guardLastName'])) {
    array_push($pErr, "Please input last name of patient's guardian");
  }
  if (empty($record['drFirstName'])) {
    array_push($pErr, "Please input first name of patient's doctor");
  }
  if (empty($record['drLastName'])) {
    array_push($pErr, "Please input last name of patient's doctor");
  }
  if (empty($record['patientAge'])) {
    array_push($pErr, "Please input age of patient");
  }
  if (empty($record['patientHeight'])) {
    array_push($pErr, "Please input height of patient");
  }
  if (empty($record['patientWeight'])) {
    array_push($pErr, "Please input weight of patient");
  }
  if (empty($record['patientTemp'])) {
    array_push($pErr, "Please input temperature username");
  }
  if (empty($record['patientBloodPressure'])) {
    array_push($pErr, "Please input blood pressure of patient");
  }
  // if (empty($record['name'])) {
  //   array_push($pErr, "Please input province of patient's residence");
  // }
  if (empty($record['patientProv'])) {
    array_push($pErr, "Please input province of patient's residence");
  }
  if (empty($record['patientCity'])) {
    array_push($pErr, "Please input city of patient's residence");
  }
  if (empty($record['BrgyName'])) {
    array_push($pErr, "Please input barangay of patient's residence");
  }
  if (empty($record['patientStNo'])) {
    array_push($pErr, "Please input street number of patient's residence");
  }
  if (empty($record['patientStAddress'])) {
    array_push($pErr, "Please input street address of patient's residence");
  }

  return $pErr;

}
?>
