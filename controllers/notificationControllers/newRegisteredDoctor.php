<?php

include "../config/db.php";

$sqlselectlabresult = "SELECT * FROM pediatrician WHERE isApprove=0";
$stmtselectusers= $conn->prepare($sqlselectlabresult);
$stmtselectusers->execute();
$resultselectNum = $stmtselectusers->store_result();
$rowNum = $stmtselectusers->num_rows;

?>
