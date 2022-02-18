<?php
 error_reporting (E_ALL ^ E_NOTICE);



include "../config/db.php";

include "../controllers/authenticationControllers/doctorAssistantloginController.php";

$drAssistID = $_SESSION['doctorAssistantID'];




$search_PediaID = "";
$search_PedFirstName = "";
$search_PedLastName = "";

$byDA_FN =  "";
$byDA_LN = "";

$search_RecevID = "";
$search_RecevFN = "";
$search_RecevLN = "";

$search_patientID = "";
$search_patientFirstName = "";
$search_patientLastName = "";
$isAvailable = "";

$search_msg_assistant = "";
$receiver_ID_byDA = "";
$search_msg_assistant_sender_ID = $_SESSION['doctorAssistantID'];

$search_msg_patient = "";
$search_msg_patient_receiver_ID = "";
$search_msg_patient_sender_ID = $_SESSION['doctorAssistantID'];


$msg_error = array();


if ((isset($_POST['search_FN'])) && (isset($_POST['search_LN']))) {
   $byDA_FN =  "%{$_POST['search_FN']}%";
   $byDA_LN = "%{$_POST['search_LN']}%";


    $sql_Select_DA = "SELECT doctorassistant.doctorAssistantID, pediatrician.pediaID AS userToID, pedFirstName AS receiverFirstName,
                        pedLastName AS receiverLastName FROM pediatrician INNER JOIN doctorassistant ON
                        pediatrician.pediaID = doctorassistant.pediaID WHERE pedFirstName
                        LIKE  ? OR pedLastName LIKE  ? AND doctorAssistantID = ?
                        UNION
                        SELECT doctorassistant.doctorAssistantID, patientsID, patFirstName, patLastName
                        FROM patients INNER JOIN doctorassistant ON doctorassistant.doctorAssistantID = patients.doctorAssistantID
                        WHERE patFirstName LIKE ? OR patLastName LIKE  ?
                        AND doctorassistant.doctorAssistantID = ?";
    $stmt_DA = $conn->prepare($sql_Select_DA);
    $stmt_DA->bind_param("ssissi", $byDA_FN, $byDA_LN, $drAssistID, $byDA_FN, $byDA_LN, $drAssistID);
    $stmt_DA->execute();
    $result = $stmt_DA->get_result();
    // $row_count = $stmt_DA->get_result();


    // var_dump($dA_Result);
    // $rows = $result->num_rows;

}

if (isset($_POST['assist-to-user-search'])) {
  $sent_msg_byDA = $_POST['assist-form-message'];
  $receiver_ID_byDA = $_POST['messageToID'];

  if (empty($sent_msg_byDA)) {
    $msg_error['assist-form-message'] = "Please enter your message";

  } else if(strlen($sent_msg_byDA) > 100) {
    $msg_error['assist-form-message'] = "Message is too long";

  } else {
    $sql_insert_assist_message_search = "INSERT INTO message(userTo, userFrom, message)
                           VALUES(?, ?, ?)";
    $stmt_insert_assist_message_ = $conn->prepare($sql_insert_assist_message_search);
    $stmt_insert_assist_message_->bind_param("iis", $receiver_ID_byDA,$drAssistID, $sent_msg_byDA);
    $stmt_insert_assist_message_->execute();

}
}
