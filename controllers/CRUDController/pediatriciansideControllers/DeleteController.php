<?php

if (!isset($_SESSION)) {
  session_start();
}


include "../config/db.php";

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
}
  $sql_delete_record = "DELETE patients, medicalrecord
                        FROM patients INNER JOIN medicalrecord ON medicalrecord.patientsID = patients.patientsID
                        WHERE patientsID = ?";
  $stmt_delete_record = $conn->prepare($sql_delete_record);
  $stmt_delete_record->bind_param("i", $id);
  $stmt_delete_record->execute();
  // var_dump($stmt_delete_record);

  header('location:../views/deletepatient.php');


?>
