<?php

if (!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

$sqlselectlabresult = "SELECT * FROM laboratoryresults WHERE isSeen=0";
$stmtselectlab = $conn->prepare($sqlselectlabresult);
$stmtselectlab->execute();
$resultselectNum = $stmtselectlab->store_result();
$rowNum = $stmtselectlab->num_rows;

?>
