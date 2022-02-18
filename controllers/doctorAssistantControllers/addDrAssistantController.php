<?php

if (!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

$assistF = "";
$assistM = "";
$assistL = "";
$mobNo = "";
$birthDate = "";
$username = "";
$pCode = "";
$pCodeConf = "";
$assistDrFN = "";
$assistDrMn = "";
$assistDrLN = "";
$assistDrClinic = "";
$dateJoin = "";


$inputErrors = array();

if (isset($_POST['addassist-btn'])) {
  $assistF = $_POST['assistFirstName'];
  $assistM = $_POST['assistMiddleName'];
  $assistL = $_POST['assistLastName'];
  $mobNo = $_POST['mobileNo'];
  $birthDate = $_POST['bdate'];
  $username = $_POST['username'];
  $pCode = $_POST['passcode'];
  $pCodeConf = $_POST['passcodeConf'];
  $assistDrFN = $_POST['pedFirstName'];
  $assistDrLN = $_POST['pedLastName'];
  $assistDrClinic = $_POST['clinicName'];

  if(empty($assistF)) {
    $inputErrors['assistFirstName'] = "Please input the first name of your assistant";
  }
  if (empty($assistM)) {
    $inputErrors['assistMiddleName'] = "Please input the middle name of your assistant";
  }
  if (empty($assistL)) {
    $inputErrors['assistLastName'] = "Please input the last name of your assistant";
  }
  if (empty($mobNo)) {
    $inputErrors['mobileNo'] = "This field is required.";
  }
  if (empty($birthDate)) {
    $inputErrors['bdate'] = "Please specify assistant's date of birth";
  }
  if (empty($username)) {
    $inputErrors['username'] = "Please provide the username of your assistant";
  }
  if (empty($pCode)) {
    $inputErrors['passcode'] = "Please specify assistant's passcode";
  }
  if (empty($pCodeConf)) {
    $inputErrors['passcodeConf'] = "Please confirm the passcode of your assistant";
  }
  if($pCode !== $pCodeConf) {
    $inputErrors['passcode'] = "The passwords entered do not match. Please check your password";
  }
  if(empty($assistDrFN)){
   $inputErrors['pedFirstName'] = "Please input your first name";
  }
  if(empty($assistDrLN)){
    $inputErrors['pedLastName'] = "Please input your last name";
  }

  $assist_sql = "SELECT asstUsername FROM doctorassistant WHERE asstUsername=? LIMIT 1";
  $stmt_assist_sql = $conn->prepare($assist_sql);
  $stmt_assist_sql->bind_param("s", $username);
  $stmt_assist_sql->execute();
  $result = $stmt_assist_sql->get_result();
  $numR = $result->num_rows;
  $stmt_assist_sql->close();

  if ($numR > 0){
    $inputErrors['username'] = "This username is already existing, please provide another username.";
  }

  $doctor_details = "SELECT pediatrician.pediaID, pediatrician.pedFirstName, pediatrician.pedLastName, clinic.clinicID,
                    clinic.name AS cname FROM clinic INNER JOIN clinicpedia ON clinic.clinicID = clinicpedia.clinicID
                    INNER JOIN pediatrician ON clinicpedia.pediaID = pediatrician.pediaID
                    WHERE pediatrician.pedFirstName = ? AND pediatrician.pedLastName = ?";
  $stmt_doctor = $conn->prepare($doctor_details);
  $stmt_doctor->bind_param("ss", $assistDrFN, $assistDrLN);
  $stmt_doctor->execute();
  $result = $stmt_doctor->get_result();

  while ($row = $result->fetch_assoc()) {
    $pediaID = $row['pediaID'];
    $clinicID = $row['clinicID'];

    if(count($inputErrors) === 0) {
      $pCode = password_hash($pCode, PASSWORD_ARGON2I);

      $sql_insert_assistant = "INSERT INTO doctorassistant(clinicID, pediaID,
                               assistFirstName, assistMiddleName, assistLastName,
                               mobileNo, assistBirthDate,
                               asstUsername, passcode)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt_insert_assistant = $conn->prepare($sql_insert_assistant);
      $stmt_insert_assistant->bind_param("iisssssss", $clinicID, $pediaID,
                                         $assistF, $assistM, $assistL, $mobNo, $birthDate,
                                         $username, $pCode);

      if ($stmt_insert_assistant->execute()){
        $doctorassistantid = $conn->insert_id;
        $_SESSION['doctorAssistantID'] = $doctorassistantid;
        $_SESSION['AFirstName'] = $assistFirstName;
        $_SESSION['AMiddleName'] = $assistMiddleName;
        $_SESSION['ALastName'] = $assistLastName;
        $_SESSION['dateJoined'] = $dateJoin;
        date_default_timezone_set('M-d Yl h:i:s A');
        $dateJoin = date('M-d Y l h:i:s A');

        header('location:../views/adddoctorassistant.php');

        $_SESSION['assistantMessage'] = $assistFirstName . " " . $assistLastName . " is now added on " .
                                        $dateJoin;
      }
      exit();

    }
  }

}


?>
