<?php

include "../config/db.php";

if (isset($_GET['cat'])) {
  $delCat = $_GET['cat'];
}



$sqlDeleteLabCategory = "DELETE FROM laboratoryresults WHERE labResultID = ?";
$stmtDelCat = $conn->prepare($sqlDeleteLabCategory);
$stmtDelCat->bind_param("s", $delCat);
$stmtDelCat->execute();


?>
