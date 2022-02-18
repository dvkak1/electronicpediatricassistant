<?php

include "../config/db.php";

$sqlShowLabTestCategory = "SELECT * FROM laboratoryresults";
$stmtShowLabTestCat = $conn->prepare($sqlShowLabTestCategory);
$stmtShowLabTestCat->execute();
$result = $stmtShowLabTestCat->get_result();
?>
