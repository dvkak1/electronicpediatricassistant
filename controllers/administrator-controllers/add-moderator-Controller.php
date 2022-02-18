<?php

include "../config/db.php";

if (!isset($_SESSION)){
  session_start();
}

$moderatorF = "";
$moderatorM = "";
$moderatorL = "";
$mobNo = "";
$birthDate = "";
$username = "";
$pCode = "";
$pCodeConf = "";
$moderatorDrClinic = "";
$dateJoin = "";


$inputErrors = array();

if (isset($_POST['add-moderator'])) {
  $moderatorF = $_POST['modFirstName'];
  $moderatorM = $_POST['modMiddleName'];
  $moderatorL = $_POST['modLastName'];
  $mobNo = $_POST['modmobNo'];
  $birthDate = $_POST['bdate'];
  $username = $_POST['username'];
  $pCode = $_POST['passcode'];
  $pCodeConf = $_POST['passcodeConf'];

  if(empty($moderatorF)) {
    $inputErrors['modFirstName'] = "Please input the first name of your moderator";
  }
  if (empty($moderatorM)) {
    $inputErrors['modMiddleName'] = "Please input the middle name of your moderator";
  }
  if (empty($moderatorL)) {
    $inputErrors['modLastName'] = "Please input the last name of your moderator";
  }
  if (empty($mobNo)) {
    $inputErrors['modmobNo'] = "This field is required.";
  }
  if (empty($birthDate)) {
    $inputErrors['bdate'] = "Please specify moderator's date of birth";
  }
  if (empty($username)) {
    $inputErrors['username'] = "Please provide the username of moderator";
  }
  if (empty($pCode)) {
    $inputErrors['passcode'] = "Please specify moderator's passcode";
  }
  if (empty($pCodeConf)) {
    $inputErrors['passcodeConf'] = "Please confirm the passcode of your moderator";
  }
  if($pCode !== $pCodeConf) {
    $inputErrors['passcode'] = "The passwords entered do not match. Please check your password";
  }


  $moderator_sql = "SELECT username FROM  moderator WHERE username=? LIMIT 1";
  $stmt_moderator_sql = $conn->prepare($moderator_sql);
  $stmt_moderator_sql->bind_param("s", $username);
  $stmt_moderator_sql->execute();
  $result = $stmt_moderator_sql->get_result();
  $numR = $result->num_rows;
  $stmt_moderator_sql->close();

  if ($numR > 0){
    $inputErrors['username'] = "This username is already existing, please provide another username.";
  }

  if(count($inputErrors) === 0) {
    $pCode = password_hash($pCode, PASSWORD_ARGON2I);

    $sql_insert_moderator = "INSERT INTO moderator(modFirstName, modMiddleName,
                             modLastName, mobileNo, username, passcode, birthdate)
                             VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert_moderator = $conn->prepare($sql_insert_moderator);
    $stmt_insert_moderator->bind_param("sssssss", $moderatorF, $moderatorM, $moderatorL, $mobNo, $username,
                                      $pCode, $birthDate);

    if ($stmt_insert_moderator->execute()) {
      $moderatorid = $conn->insert_id;
      $_SESSION['moderatorID'] = $moderatorid;
      $_SESSION['modFirstName'] = $moderatorF;
      $_SESSION['modMiddleName'] = $moderatorM;
      $_SESSION['modLastName'] = $$moderatorL;
      $_SESSION['dateJoined'] = $dateJoin;
      date_default_timezone_set('M-d Yl h:i:s A');
      $dateJoin = date('M-d Y l h:i:s A');

      header('location:../views/addmoderator.php');

      $_SESSION['moderatorMessage'] = $moderatorF . " " . $moderatorL . " is now added on " .
                                      $dateJoin;
    }

  }


}




?>
