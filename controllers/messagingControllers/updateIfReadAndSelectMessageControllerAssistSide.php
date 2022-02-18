<?php

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";


if (isset($_GET['patientID'])) {
  $update_message = "UPDATE message SET isRead = 1 WHERE userFrom=? AND userTo=? AND isRead=?";
  $stmt_update_message = $conn->prepare($update_message);
  $stmt_update_message->bind_param("iii", $patientID, $asstID, $isRead);
  $stmt_update_message->execute();
}

if(isset($_GET['pediaID'])) {
  $update_message_2 = "UPDATE message SET isRead = 1 WHERE userFrom=? AND userTo=? AND isRead=?";
  $stmt_update_message_2 = $conn->prepare($update_message_2);
  $stmt_update_message_2->bind_param("iii",  $pedID, $asstID, $isRead);
  $stmt_update_message_2->execute();
}

$select_msg_doctor = "SELECT * FROM message WHERE userFrom=? AND userTo =?
               OR userTo=? AND userFrom=?
               OR userFrom=? AND userTo=?
               OR userTo=? AND userFrom=?
               ORDER BY 1 ASC";
$stmt_select_msg_asst = $conn->prepare($select_msg_doctor);
$stmt_select_msg_asst->bind_param("iiiiiiii",  $patientID, $asstID, $patientID, $asstID, $pedID, $asstID, $pedID, $asstID);
$stmt_select_msg_asst->execute();
$result_asst = $stmt_select_msg_asst->get_result();


?>
