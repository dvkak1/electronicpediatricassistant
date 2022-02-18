<?php

if (!isset($_SESSION)) {
  session_start();
}


include "config/db.php";


$sql = "SELECT pediatrician.*, clinic.*, clinicpedia.* FROM pediatrician
        INNER JOIN clinicpedia ON pediatrician.pediaID = clinicpedia.pediaID
        INNER JOIN clinic ON clinic.clinicID = clinicpedia.clinicID";
$stmt_select_dropdown = $conn->prepare($sql);
$stmt_select_dropdown->execute();
$result_dropdown = $stmt_select_dropdown->get_result();


?>
