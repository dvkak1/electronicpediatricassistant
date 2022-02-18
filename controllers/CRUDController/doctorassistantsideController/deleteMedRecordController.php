<?php

include "../config/db.php";

$recNoDelete = $_GET['mrID'];
$reasonDel = "";
$recordID = "";

if (isset($_POST['enter-reason'])) {
  $reasonDel = $_POST['deletereason'];
  $recordID = $_POST['recID'];

    $sqlDeleteRecord = "UPDATE medicalrecord SET isDelete=1, deleteReason=? WHERE medicalrecord.medRecordID=?";
    $stmtDelete = $conn->prepare($sqlDeleteRecord);
    $stmtDelete->bind_param("si", $reasonDel, $recordID);
    $stmtDelete->execute();

    header('location:../views/patientmedicalrecordsdrasstview.php');
}
?>
