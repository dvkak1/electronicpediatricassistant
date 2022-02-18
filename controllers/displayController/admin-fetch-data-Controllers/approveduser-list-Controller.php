<?php

include "../config/db.php";

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

$sqlselectAllRegUsers = "SELECT pediatrician.*, specialization.* FROM pediatrician
                         INNER JOIN specialization
                         ON pediatrician.specializationID = specialization.specializationID
                         WHERE isApprove=1";
$stmtselectRegUsers = $conn->prepare($sqlselectAllRegUsers);
$stmtselectRegUsers->execute();
$resultSelect = $stmtselectRegUsers->get_result();

?>
