<?php

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";
include "../controllers/authenticationControllers/signinaspatientController.php";


$patient_ID = $_SESSION['patientno'];

$ptFN = "";
$ptMN = "";
$ptLN = "";

$isRead = 0;

$pedia_ID_Patient = "";
$pedia_First_Name = "";
$pedia_Last_Name = "";

$drAssist_ID_Patient = "";
$drAssist_First_Name = "";
$drAssist_Last_Name = "";

$sender = "";
$receiver = "";
$message = "";
$dateTimeSent = " ";

$msg_new = "";

$msg_new_pedia = "";

$msg_error = array();


$sql_select = "SELECT * FROM patients WHERE patientsID = ?";
$stmt = $conn->prepare($sql_select);
$stmt->bind_param("i", $patient_ID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$ptFN = $row['patFirstName'];
$ptMN = $row['patMiddleName'];
$ptLN = $row['patLastName'];

$sql_show_pediatrician = "SELECT doctorassistant.*, pediatrician.* FROM doctorassistant
                          INNER JOIN pediatrician ON doctorassistant.pediaID = pediatrician.pediaID
                          INNER JOIN patients ON pediatrician.pediaID = patients.pediaID
                          WHERE patients.patientsID = ?";
$stmt_show_pediatrician = $conn->prepare($sql_show_pediatrician);
$stmt_show_pediatrician->bind_param("i", $patient_ID);
$stmt_show_pediatrician->execute();
$result_show_pediatrician = $stmt_show_pediatrician->get_result();
$row_result = $result_show_pediatrician->fetch_assoc();


$pedia_ID_Patient = $row_result['pediaID'];
$pedia_First_Name = $row_result['pedFirstName'];
$pedia_Middle_Name = $row_result['pedMiddleName'];
$pedia_Last_Name = $row_result['pedLastName'];
$drAssist_ID_Patient = $row_result['doctorAssistantID'];
$drAssist_First_Name = $row_result['assistFirstName'];
$drAssist_Last_Name = $row_result['assistLastName'];

$total_messages = "SELECT * FROM message WHERE userFrom=?
                  AND userTo=? AND isRead=?";
$stmt_total_messages = $conn->prepare($total_messages);
$stmt_total_messages->bind_param("iii", $pedia_ID_Patient, $patient_ID, $isRead);
$stmt_total_messages->execute();
$stmt_total_messages->store_result();
$row_total = $stmt_total_messages->num_rows;

$total_messages_2 = "SELECT * FROM message WHERE userFrom=?
                  AND userTo=? AND isRead=?";
$stmt_total_messages_2 = $conn->prepare($total_messages_2);
$stmt_total_messages_2->bind_param("iii", $drAssist_ID_Patient, $patient_ID, $isRead);
$stmt_total_messages_2->execute();
$stmt_total_messages_2->store_result();
$row_total_2 = $stmt_total_messages_2->num_rows;


if (isset($_POST['send-message'])) {
  $msg_new = $_POST['message'];

  if (empty($msg_new)){
    $msg_error['message'] = "Please enter your message";
  } else if (strlen($msg_new) > 100) {
    $msg_error['message'] = "Message is too long";
  } else {
    $sql_insert_patient_message = "INSERT INTO message(userTo, userFrom, message)
                                   VALUES(?, ?, ?)";
    $stmt_insert_message = $conn->prepare($sql_insert_patient_message);
    $stmt_insert_message->bind_param("iis", $drAssist_ID_Patient, $patient_ID, $msg_new);
    $stmt_insert_message->execute();
  }

}

if (isset($_POST['send-pedia-message'])) {
  $msg_new_pedia = $_POST['pedia-message'];

  if (empty($msg_new_pedia)){
    $msg_error['pedia-message'] = "Please enter your message";
  } else if (strlen($msg_new_pedia) > 100) {
    $msg_error['pedia-message'] = "Message is too long";
  } else {
    $sql_insert_patient_message_pedia = "INSERT INTO message(userTo, userFrom, message)
                                   VALUES(?, ?, ?)";
    $stmt_insert_message = $conn->prepare($sql_insert_patient_message_pedia);
    $stmt_insert_message->bind_param("iis", $pedia_ID_Patient, $patient_ID, $msg_new_pedia);
    $stmt_insert_message->execute();
  }
}

?>
