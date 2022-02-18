<?php

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

if (!isset($_SESSION['doctorAssistantID'])) {
  header('location:../views/doctorassistantlogin.php');
  exit();
}

$assistFN = "";
$assistLN = "";
$pediaFN = "";
$pediaLN = "";
$clName = "";



$sql_display_doctorassistant = "SELECT doctorassistant.assistFirstName,
                      doctorassistant.assistLastName, pediatrician.pedFirstName,
                      pediatrician.pedLastName, clinic.name AS cName
                      FROM doctorassistant
                      INNER JOIN pediatrician ON doctorassistant.pediaID = pediatrician.pediaID
                      INNER JOIN clinicpedia ON pediatrician.pediaID = clinicpedia.pediaID
                      INNER JOIN clinic ON clinicpedia.clinicID = clinic.clinicID
                      AND doctorassistant.doctorAssistantID = ?";
$stmt_display_doctorassistant = $conn->prepare($sql_display_doctorassistant);
$stmt_display_doctorassistant->bind_param("s", $_SESSION['doctorAssistantID']);
$stmt_display_doctorassistant->execute();
$assistResult = $stmt_display_doctorassistant->get_result();
$rows = $assistResult->fetch_assoc();

  $assistFN = $rows['assistFirstName'];
  $assistLN = $rows['assistLastName'];
  $pediaFN = $rows['pedFirstName'];
  $pediaLN = $rows['pedLastName'];
  $clName = $rows['cName'];



?>
