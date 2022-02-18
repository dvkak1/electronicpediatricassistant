<?php

include "../config/db.php";


$sql = "SELECT DISTINCT category FROM laboratoryresults";
$stmtdropdown = $conn->prepare($sql);
$stmtdropdown->execute();
$result =  $stmtdropdown->get_result();



?>
