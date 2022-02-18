<?php

if (!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

if(isset($_GET['pediaID'])) {
  $update_patient_message = "UPDATE message SET IsRead = 1 WHERE userFrom=? AND userTo=? AND IsRead=?";
  $stmt_update_patient_message = $conn->prepare($update_patient_message);
  $stmt_update_patient_message->bind_param("iii", $pedia_ID_Patient, $patient_ID, $isRead);
  $stmt_update_patient_message->execute();
}

if(isset($_GET['drAssistID'])) {
  $update_patient_message_2 = "UPDATE message SET IsRead= 1 WHERE userFrom=? AND userTo=? AND IsRead=?";
  $stmt_update_patient_message_2 = $conn->prepare($update_patient_message_2);
  $stmt_update_patient_message_2->bind_param("iii", $drAssist_ID_Patient, $patient_ID, $isRead);
  $stmt_update_patient_message_2->execute();
}

$select_patient_msg = "SELECT * FROM message WHERE userFrom=? AND userTo=? OR
                       userTo=? AND userFrom=? OR
                       userFrom=? AND userTo=? OR
                       userTo=? AND userFrom=?
                       ORDER BY 1 ASC";
$stmt_select_patient_msg = $conn->prepare($select_patient_msg);
$stmt_select_patient_msg->bind_param("iiiiiiii", $pedia_ID_Patient, $patient_ID, $pedia_ID_Patient, $patient_ID, $drAssist_ID_Patient, $patient_ID, $drAssist_ID_Patient,  $patient_ID);
$stmt_select_patient_msg->execute();
$result = $stmt_select_patient_msg->get_result();


?>
