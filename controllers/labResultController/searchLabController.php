<?php
  if (!isset($_SESSION)){
    session_start();
  }

  include "../config/db.php";

  $IMAGE = "";

  if (isset($_POST['searchlabres-btn'])) {
    $searchfirst = $_POST['firstnlab'];
    $searchmid = $_POST['midnlab'];
    $searchlast = $_POST['lastnlab'];
  }

  $sql_search = "SELECT * FROM laboratoryresults INNER JOIN patients
                ON laboratoryresults.patientsID = patients.patientsID
                WHERE patients.patFirstName = ? AND patients.patMiddleName = ?
                AND patients.patLastName =?";
  $stmt_search = $conn->prepare($sql_search);
  $stmt_search->bind_param("sss", $searchfirst, $searchmid, $searchlast);
  $stmt_search->execute();
  $result = $stmt_search->get_result();

?>
