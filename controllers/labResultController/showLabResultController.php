<?php


include "../config/db.php";

$sqlselectlabresult = "SELECT * FROM laboratoryresults WHERE isSeen=0 AND labResultID=?";
$selectnotseenlabresult = $conn->prepare($sqlselectlabresult);
$selectnotseenlabresult->bind_param("i", $_GET['labID']);
$selectnotseenlabresult->execute();
$resultlab = $selectnotseenlabresult->get_result();
?>
