<?php

include "../config/db.php";


$pedFN = "";
$pedLN = "";
$pedContNo = "";
$pedSpecia = "";
$pedHospAf = "";
$pedClinic = "";
$pedServices = "";
$pedSchedule = "";


if (isset($_GET['pedID'])){
  $thisPedID = $_GET['pedID'];
}


$sqlpedprof = "SELECT pediatrician.* , specialization.*, clinic.name AS clName, clinicpedia.*,
               hospitalaffiliation.*, clinicpedschedule.*, pedia_profile.*, pedia_hosp.*, services.*
               FROM pediatrician
               INNER JOIN specialization ON
               pediatrician.specializationID = specialization.specializationID
                INNER JOIN clinicpedia ON pediatrician.pediaID = clinicpedia.pediaID
                INNER JOIN clinic ON clinicpedia.clinicID = clinic.clinicID
                INNER JOIN clinicpedschedule ON clinicpedschedule.pediaID = pediatrician.pediaID
                INNER JOIN pedia_hosp ON pedia_hosp.pediaID = pediatrician.pediaID
                INNER JOIN pedia_profile ON pedia_profile.pediaID = pediatrician.pediaID
                INNER JOIN pediaservice ON pediaservice.pediaID = pediatrician.pediaID
                INNER JOIN services ON services.serviceID = pediaservice.serviceID
                INNER JOIN hospitalaffiliation ON hospitalaffiliation.hospAfID = pedia_hosp.hospAfID
                 WHERE pediatrician.pediaID = ?";
$stmtpedprof = $conn->prepare($sqlpedprof);
$stmtpedprof->bind_param("i", $thisPedID);
$stmtpedprof->execute();
$result = $stmtpedprof->get_result();
$row = $result->fetch_assoc();

$pedFN = $row['pedFirstName'];
$pedLN = $row['pedLastName'];
$pedSpecia = $row['specialization_name'];
$pedHospAf = $row['hospitalName'];
$pedContNo = $row['mobileNo'];
$pedClinic = $row['clName'];
$pedProfImage = $row['prof_image'];
$pedServices = $row['serviceType'];
$pedSchedule = $row['schedule'];
?>
