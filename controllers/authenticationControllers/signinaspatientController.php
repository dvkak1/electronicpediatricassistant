<?php
//
if (!isset($_SESSION)){
session_start();
}

include "../config/db.php";

$ptfn = "";
$ptmn = "";
$ptln = "";
$ptno = "";
$patientLoginErrors = array();

if (isset($_POST['patientlogin-btn'])) {
  $ptfn = $_POST['patientfirstname'];
  $ptln = $_POST['patientlastname'];
  $ptno = $_POST['patientno'];

  if (empty($ptfn)){
    $patientLoginErrors['patientfirstname'] = "Please input your first name";
  }
  if (empty($ptln)){
    $patientLoginErrors['patientlastname'] = "Please input your last name";
  }
  if (empty($ptno)){
    $patientLoginErrors['patientno'] = "Please input your patient number";
  }

  if (count($patientLoginErrors) === 0) {
    $sql_stmt_select = "SELECT * FROM patients WHERE patFirstName = ? AND patLastName = ? AND patientsID = ?";
    $stmt = $conn->prepare($sql_stmt_select);
    $stmt->bind_param("ssi", $ptfn, $ptln, $ptno);
    $stmt->execute();
    $result = $stmt->get_result();
    $userPatient = $result->fetch_assoc();
    // var_dump($user);
    // echo "<pre>",print_r($userPatient),"</pre>";

    if($userPatient){
      $_SESSION['patientno'] = $userPatient['patientsID'];
      $_SESSION['patientfirstname'] = $userPatient['patFirstName'];
      $_SESSION['patientlastname'] = $userPatient['patLastName'];

      header('location:../views/patientsportal.php');
      // header('location:..//viewpatientrecord.php');
      exit();
    } else {
      $patientLoginErrors['login-fail'] = "Wrong credentials";
    }
  }
}


if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['patientno']);
  unset($_SESSION['patientfirstname']);
  unset($_SESSION['patientlastname']);
  header('location:../index.php');
  exit();
}


?>
