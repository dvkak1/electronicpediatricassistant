<?php

 error_reporting (E_ALL ^ E_NOTICE);


include "../config/db.php";



$patID = $_SESSION['patientno'] ;

$search_FN_Patient = "";
$search_LN_Patient = "";

$search_RecevID = "";
$search_RecevFN = "";
$search_RecevLN = "";

$sendMsgPatient = "";
$sendMsgReceiveID = "";
$sendMsgSendID = $_SESSION['patientno'];


$msg_error = array();


if ((isset($_POST['search_patfirstN'])) && (isset($_POST['search_patlastN']))) {
   $search_FN_Patient =  "%{$_POST['search_patfirstN']}%";
   $search_LN_Patient = "%{$_POST['search_patlastN']}%";


    $sql_Patient_Select = "SELECT patients.patientsID, pediatrician.pediaID AS userToID, pedFirstName AS receiverFirstName,
                                pedLastName AS receiverLastName FROM pediatrician INNER JOIN patients ON pediatrician.pediaID = patients.pediaID
                                WHERE pedFirstName LIKE ? OR pedLastName LIKE ? AND patients.patientsID = ?
                                UNION
                                SELECT patients.patientsID, doctorassistant.doctorAssistantID, doctorassistant.assistFirstName, doctorassistant.assistLastName FROM
                                patients INNER JOIN doctorassistant ON patients.doctorAssistantID = doctorassistant.doctorAssistantID
                                WHERE assistFirstName LIKE ? OR assistLastName LIKE ? AND patients.patientsID =?
                                LIMIT 1";
    $stmtPatient = $conn->prepare($sql_Patient_Select);
    $stmtPatient->bind_param("ssissi", $search_FN_Patient, $search_LN_Patient, $patID, $search_FN_Patient, $search_LN_Patient, $patID);
    $stmtPatient->execute();
    $result = $stmtPatient->get_result();


}




if (isset($_POST['patient-msg'])) {
  $sendMsgPatient = $_POST['patient-form-message'];
  $sendMsgReceiveID= $_POST['messageToID'];

  if (empty($sendMsgPatient)) {
    $msg_error['patient-form-message'] = "Please enter your message";

  } else if(strlen($sendMsgPatient) > 100) {
    $msg_error['patient-form-message'] = "Message is too long";

  } else {
    $sqlPatientMsg = "INSERT INTO message(userTo, userFrom, message)
                           VALUES(?, ?, ?)";
    $stmtPatientMsg = $conn->prepare($sqlPatientMsg);
    $stmtPatientMsg->bind_param("iis", $sendMsgReceiveID, $sendMsgSendID, $sendMsgPatient);
    $stmtPatientMsg->execute();
    // var_dump($stmtPatientMsg);
    // var_dump($stmt_insert_assist_message_);
  }
 }


?>
