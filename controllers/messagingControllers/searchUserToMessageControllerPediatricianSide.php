<?php

 error_reporting (E_ALL ^ E_NOTICE);
include "../config/db.php";
//
// include "../controllers/authenticationControllers/loginController.php";

$pedID = $_SESSION['id'] ;

$search_msg_query_FN = "";
$search_msg_query_LN = "";
$search_msg_query_FN_Patient = "";
$search_msg_query_LN_Patient = "";

$search_PediaID = "";
$search_PedFirstName = "";
$search_PedLastName = "";

$search_RecevID = "";
$search_RecevFN = "";
$search_RecevLN = "";

$search_patientID = "";
$search_patientFirstName = "";
$search_patientLastName = "";
$isAvailable = "";

$search_msg_assistant = "";
$search_msg_receiver_ID = "";
$search_msg_sender_ID = $_SESSION['id'];

$search_msg_patient = "";
$search_msg_patient_receiver_ID = "";
$search_msg_patient_sender_ID = $_SESSION['id'];


$msg_error = array();


if ((isset($_POST['search_firstN'])) && (isset($_POST['search_lastN']))) {
   $search_msg_query_FN =  "%{$_POST['search_firstN']}%";
   $search_msg_query_LN = "%{$_POST['search_lastN']}%";

    $sql_Select_user = "SELECT pediaID, doctorAssistantID AS userToID, assistFirstName AS receiverFirstName, assistLastName AS receiverLastName FROM doctorassistant
                        WHERE assistFirstName LIKE ? OR assistLastName LIKE ? AND pediaID = ? UNION
                        SELECT pediaID, patientsID, patFirstName, patLastName FROM patients WHERE
                        patFirstName LIKE ? OR patLastName LIKE ? AND pediaID = ?";
    $stmt_select_user = $conn->prepare($sql_Select_user);
    $stmt_select_user->bind_param("ssissi", $search_msg_query_FN, $search_msg_query_LN, $pedID, $search_msg_query_FN, $search_msg_query_LN, $pedID);
    $stmt_select_user->execute();
    $result = $stmt_select_user->get_result();


}




if (isset($_POST['doctor-to-user-search'])) {
  $search_msg_ = $_POST['search-form-message'];
  $search_msg_receiver_ID = $_POST['messageToID'];

  if (empty($search_msg_)) {
    $msg_error['search-form-message'] = "Please enter your message";

  } else if(strlen($search_msg_) > 100) {
    $msg_error['search-form-message'] = "Message is too long";

  } else {
    $sql_insert_assist_message_search = "INSERT INTO message(userTo, userFrom, message)
                           VALUES(?, ?, ?)";
    $stmt_insert_assist_message_ = $conn->prepare($sql_insert_assist_message_search);
    $stmt_insert_assist_message_->bind_param("iis", $search_msg_receiver_ID, $search_msg_sender_ID, $search_msg_);
    $stmt_insert_assist_message_->execute();
  }
 }
