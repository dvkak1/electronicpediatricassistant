<?php

if (!isset($_SESSION)) {
 session_start();
}

include "../config/db.php";
include "../controllers/authenticationControllers/loginController.php";
include "../controllers/functionsFolder/functions.php";

//GETTING INFORMATION ON PEDIATRICIAN ON USER ON SESSION
$pedia = $_SESSION['email'];

// echo $pedia;

$pedID = "";
$pFN = "";
$pMN = "";
$pLN = "";

$isRead = 0;

$patients_ID = "";
$patientFirstName = "";
$patientLastName = "";
$assistant_ID = "";
$drAssistFN = "";
$drAssistLN = "";

$patientFirstName_2 = "";
$patientLastName_2 = "";

$drassistFirstName_2 = "";
$drassistLastName_2 = "";

$sender = "";
$receiver = "";
$message = "";
$dateTimeSent = " ";

$msg_new = "";

$msg_error = array();

$sql_select = "SELECT * FROM pediatrician WHERE email =?";
$stmt = $conn->prepare($sql_select);
$stmt->bind_param("s", $pedia);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


$pedID = $row['pediaID'];
$pFN = $row['pedFirstName'];
$pMN = $row['pedMiddleName'];
$pLN = $row['pedLastName'];

//GETTING LIST OF RECIPIENT
$sql_show_users = "SELECT pediatrician.*, patients.* FROM
                    pediatrician INNER JOIN patients ON patients.pediaID = pediatrician.pediaID
                    WHERE pediatrician.pediaID = ? ";
$stmt_recipient = $conn->prepare($sql_show_users);
$stmt_recipient->bind_param("i", $pedID);
$stmt_recipient->execute();
$result_recipient = $stmt_recipient->get_result();
$row_recipient = $result_recipient->fetch_assoc();

$patient_ID = $row_recipient['patientsID'];
$patient_FN = $row_recipient['patFirstName'];
$patient_LN = $row_recipient['patLastName'];

$sql_show_doctorassistant = "SELECT pediatrician.*, doctorassistant.* FROM doctorassistant
                             INNER JOIN pediatrician ON pediatrician.pediaID = doctorassistant.pediaID
                             WHERE pediatrician.pediaID = ?";
$stmt_recipient_2 = $conn->prepare($sql_show_doctorassistant);
$stmt_recipient_2->bind_param("i", $pedID);
$stmt_recipient_2->execute();
$result_recipient_2 = $stmt_recipient_2->get_result();
$row_recipient_2 = $result_recipient_2->fetch_assoc();

$assistant_ID = $row_recipient_2['doctorAssistantID'];
$drAssistFN = $row_recipient_2['assistFirstName'];
$drAssistLN = $row_recipient_2['assistLastName'];


$total_messages = "SELECT * FROM message WHERE userFrom=?
                  AND userTo=? AND isRead=?";
$stmt_total_messages = $conn->prepare($total_messages);
$stmt_total_messages->bind_param("iii", $patient_ID,  $pedID, $isRead);
$stmt_total_messages->execute();
$stmt_total_messages->store_result();
$row_total = $stmt_total_messages->num_rows;

$total_messages_2 = "SELECT * FROM message WHERE userFrom=?
                  AND userTo=? AND isRead=?";
$stmt_total_messages_2 = $conn->prepare($total_messages);
$stmt_total_messages_2->bind_param("iii",  $assistant_ID, $pedID, $isRead);
$stmt_total_messages_2->execute();
$stmt_total_messages_2->store_result();
$row_total_2 = $stmt_total_messages_2->num_rows;


if(isset($_POST['send-patient-message'])) {
  $msg_new = $_POST['message'];

  if (empty($msg_new)) {
    $msg_error['message'] = "Please enter your message";
  } else if(strlen($msg_new) > 100) {
    $msg_error['message'] = "Message is too long";
  } else {
    $sql_insert_message = "INSERT INTO message(userTo, userFrom, message)
                           VALUE(?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert_message);
    $stmt_insert->bind_param("iis", $patient_ID, $pedID, $msg_new);
    $stmt_insert->execute();


  }
}

if (isset($_POST['send-assist-message'])) {
  $msg_new_assist = $_POST['message'];

  if (empty($msg_new_assist)) {
    $msg_error['message'] = "Please enter your message";
  } else if(strlen($msg_new_assist) > 100) {
    $msg_error['message'] = "Message is too long";
  } else {
    $sql_insert_message = "INSERT INTO message(userTo, userFrom, message)
                           VALUE(?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert_message);
    $stmt_insert->bind_param("iis", $assistant_ID, $pedID, $msg_new_assist);
    $stmt_insert->execute();

  }
}
