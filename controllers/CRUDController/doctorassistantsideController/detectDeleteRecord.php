<?php

include "../config/db.php";


$sfnmedrecDel = "";
$smnmedrecDel = "";
$slnmedrecDel = "";

if (isset($_POST['search-medrec-btn'])) {
  $sfnmedrec = $_POST['patFirstName'];
  $smnmedrec = $_POST['patMiddleName'];
  $slnmedrec = $_POST['patLastName'];
}

$sql_deleted_rec = "SELECT patients.*, medicalrecord.*, pediatrician.*, province.name AS provName,
                    city.name AS ctyName, street_address.*, barangay.* FROM patients
                    INNER JOIN medicalrecord ON patients.patientsID = medicalrecord.patientsID
                    INNER JOIN pediatrician ON patients.pediaID = pediatrician.pediaID
                    INNER JOIN province ON patients.Prov_ID = province.Prov_ID
                    INNER JOIN city ON patients.cityID = city.cityID
                    INNER JOIN street_address ON patients.streetAddressID =
                    street_address.streetAddressID
                    INNER JOIN barangay ON patients.BrgyID = barangay.BrgyID
                    WHERE patFirstName=?
                    AND patMiddleName=?
                    AND patLastName=?
                    AND medicalrecord.isDelete=1";
$stmt_check_Delete = $conn->prepare($sql_deleted_rec);
$stmt_check_Delete->bind_param("sss", $sfnmedrec, $smnmedrec, $slnmedrec);
$stmt_check_Delete->execute();
$result = $stmt_check_Delete->get_result();



?>
