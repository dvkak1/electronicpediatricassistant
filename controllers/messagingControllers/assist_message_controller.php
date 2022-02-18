<?php

include "../config/db.php";

include "../controllers/authenticationControllers/doctorAssistantLoginController.php";

$asstUsername = $_SESSION['assistUN'];

$asstID = "";
$asstFirstName = "";
$asstLastName = "";

$patientID = "";
$patientFN = "";
$patientLN = "";

$pediaID = "";
$pediaFN = "";
$pediaLN = "";

$isRead = 0;

// if (isset($_GET['drID'])) {
//   $drID = $_GET['drID'];
// }

$sql_select = "SELECT * FROM doctorassistant WHERE asstUsername=?";
$stmt = $conn->prepare($sql_select);
$stmt->bind_param("s", $asstUsername);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$asstID = $row['doctorAssistantID'];
$asstFirstName = $row['assistFirstName'];
$asstLastName = $row['assistLastName'];

$sqlselectpatient = "SELECT doctorassistant.*, pediatrician.*, patients.* FROM doctorassistant
                     INNER JOIN pediatrician ON doctorassistant.pediaID = pediatrician.pediaID
                     INNER JOIN patients ON patients.pediaID = pediatrician.pediaID
                     INNER JOIN medicalrecord ON medicalrecord.doctorAssistantID = doctorassistant.doctorAssistantID
                     WHERE doctorassistant.doctorAssistantID =  ?";
$stmtselectpatient = $conn->prepare($sqlselectpatient);
$stmtselectpatient->bind_param("i", $asstID);
$stmtselectpatient->execute();
$resultpat = $stmtselectpatient->get_result();
$rowpatient = $resultpat->fetch_assoc();

$patientID = $rowpatient['patientsID'];
$patientFN = $rowpatient['patFirstName'];
$patientLN = $rowpatient['patLastName'];

$sqlselectpediatrician = "SELECT pediatrician.*, doctorassistant.* FROM doctorassistant INNER JOIN pediatrician ON doctorassistant.pediaID = pediatrician.pediaID
                          WHERE doctorassistant.doctorAssistantID = ?";
$stmtselectped = $conn->prepare($sqlselectpediatrician);
$stmtselectped->bind_param("i", $asstID);
$stmtselectped->execute();
$resultped = $stmtselectped->get_result();
$rowped = $resultped->fetch_assoc();

$pedID = $rowped['pediaID'];
$pedFirstName = $rowped['pedFirstName'];
$pedLastName = $rowped['pedLastName'];

$total_messages = "SELECT * FROM message WHERE userFrom=?
                  AND userTo=? AND isRead=?";
$stmt_total_messages = $conn->prepare($total_messages);
$stmt_total_messages->bind_param("iii", $patientID, $asstID, $isRead);
$stmt_total_messages->execute();
$stmt_total_messages->store_result();
$row_total = $stmt_total_messages->num_rows;

$total_messages_2 = "SELECT * FROM message WHERE userFrom=?
                  AND userTo=? AND isRead=?";
$stmt_total_messages_2 = $conn->prepare($total_messages);
$stmt_total_messages_2->bind_param("iii",  $pedID,  $asstID, $isRead);
$stmt_total_messages_2->execute();
$stmt_total_messages_2->store_result();
$row_total_2 = $stmt_total_messages_2->num_rows;

if(isset($_POST['send-patient-message'])) {
  $msgnew = $_POST['message'];

  if (empty($msgnew)) {
    $msg_error['message'] = "Please enter your message";
  } else if(strlen($msgnew) > 100) {
    $msg_error['message'] = "Message is too long";
  } else {
    $sqlsendmsg = "INSERT INTO message(userTo, userFrom, message)
                           VALUE(?, ?, ?)";
    $stmtmsgpat = $conn->prepare($sqlsendmsg);
    $stmtmsgpat->bind_param("iis", $patientID, $asstID, $msgnew);
    $stmtmsgpat->execute();
  }
}

if(isset($_POST['send-pediatrician-message'])) {
  $msgnewped = $_POST['message'];

  if (empty($msgnewped)) {
    $msg_error['message'] = "Please enter your message";
  } else if(strlen($msgnewped) > 100) {
    $msg_error['message'] = "Message is too long";
  } else {
    $sqlsendmsg = "INSERT INTO message(userTo, userFrom, message)
                           VALUE(?, ?, ?)";
    $stmtmsgped = $conn->prepare($sqlsendmsg);
    $stmtmsgped->bind_param("iis", $pedID, $asstID, $msgnewped);
    $stmtmsgped->execute();
  }
}


?>
