<?php

include "../config/db.php";


$drFirstName = "";
$drMiddleName = "";
$drLastName = "";
$drPhoneNum = "";
$drHospAf = "";
$drEmail = "";
$drToken = "";

if (isset($_GET['no'])) {
  $docID = $_GET['no'];

  $sqlshowuser = "SELECT pediatrician.*, hospitalaffiliation.* FROM
                  pediatrician INNER JOIN pedia_hosp ON pediatrician.pediaID = pedia_hosp.pediaID
                  INNER JOIN hospitalaffiliation ON hospitalaffiliation.hospAfID = pedia_hosp.hospAfID
                  WHERE pediatrician.pediaID=?";
  $stmt = $conn->prepare($sqlshowuser);
  $stmt->bind_param("i", $docID);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $drFirstName = $row['pedFirstName'];
  $drMiddleName = $row['pedMiddleName'];
  $drLastName = $row['pedLastName'];
  $drPhoneNum = $row['mobileNo'];
  $drHospAf = $row['hospitalName'];
  $drEmail = $row['email'];
  $drToken = $row['ActLinkToken'];
}


?>
