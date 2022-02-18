<?php

include "../config/db.php";



$sql = "SELECT patients.*, laboratoryresults.* FROM patients INNER JOIN laboratoryresults
        ON patients.patientsID = laboratoryresults.patientsID
        WHERE isSeen=0 AND category=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_GET['cat']);
$stmt->execute();
$result = $stmt->get_result();


?>
