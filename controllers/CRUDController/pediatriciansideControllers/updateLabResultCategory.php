<?php

include "../config/db.php";

if (isset($_GET['upCat'])) {
  $Cat = $_GET['upCat'];
}

$categoryShow = "";
$catLabID = "";

$catUpd = "";
$catUpdID = "";

$sqlShowCategory = "SELECT * FROM laboratoryresults WHERE labResultID=?";
$stmtCatFetch = $conn->prepare($sqlShowCategory);
$stmtCatFetch->bind_param("i", $Cat);
$stmtCatFetch->execute();
$result = $stmtCatFetch->get_result();

while ($rowCategory = $result->fetch_assoc()) {
  $categoryShow = $rowCategory['category'];
  $catLabID = $rowCategory['labResultID'];
}

if (isset($_POST['update-lab-category'])) {
  $catUpd = $_POST['labCategory'];
  $catUpdID = $_POST['labID'];

  $sqlUpdLabCategory = "UPDATE laboratoryresults SET category=? WHERE labResultID=?";
  $stmtUpdCat = $conn->prepare($sqlUpdLabCategory);
  $stmtUpdCat->bind_param("si", $catUpd, $catUpdID);
  $stmtUpdCat->execute();

}





?>
