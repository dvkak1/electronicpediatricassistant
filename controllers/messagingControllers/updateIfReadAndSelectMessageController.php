<?php

include "../config/db.php";


if (isset($_GET['patientID'])) {
  $update_message = "UPDATE message SET isRead = 1 WHERE userFrom=? AND userTo=? AND isRead=?";
  $stmt_update_message = $conn->prepare($update_message);
  $stmt_update_message->bind_param("iii",  $patient_ID, $pedID, $isRead);
  $stmt_update_message->execute();
}

if(isset($_GET['drAsstID'])) {
  $update_message_2 = "UPDATE message SET isRead = 1 WHERE userFrom=? AND userTo=? AND isRead=?";
  $stmt_update_message_2 = $conn->prepare($update_message_2);
  $stmt_update_message_2->bind_param("iii",  $assistant_ID, $pedID, $isRead);
  $stmt_update_message_2->execute();
}

$select_msg_doctor = "SELECT * FROM message WHERE userFrom=? AND userTo =?
               OR userTo=? AND userFrom=?
               OR userFrom=? AND userTo=?
               OR userTo=? AND userFrom=?
               ORDER BY 1 ASC";
$stmt_select_msg_doctor = $conn->prepare($select_msg_doctor);
$stmt_select_msg_doctor->bind_param("iiiiiiii",  $patient_ID, $pedID, $patient_ID, $pedID, $assistant_ID, $pedID, $assistant_ID, $pedID);
$stmt_select_msg_doctor->execute();
$result_doctor = $stmt_select_msg_doctor->get_result();
?>
