 <?php

if (!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

$assistUN  = "";
$assistPC = "";
$assistErrors = array();

$aPC = "";

$exe = "";

$passcode = "";

if(isset($_POST['assistantlogin-btn'])) {
  $assistUN = $_POST['assistUseName'];
  $assistPC = $_POST['assistPassCode'];

  if (empty($assistUN)){
    $assistErrors['assistUseName'] = "Please input your username";
  }
  if (empty($assistPC)) {
    $assistErrors['assistPassCode'] = "Please input your passcode";
  }

  if (count($assistErrors) === 0) {
     $passcode = password_hash($assistPC, PASSWORD_ARGON2I);


     $sql_select_assist = "SELECT * FROM doctorassistant WHERE asstUsername=? ";
     $stmt = $conn->prepare($sql_select_assist);
     $stmt->bind_param('s', $assistUN);
     $stmt->execute();
     $result = $stmt->get_result();
     $userAssist = $result->fetch_assoc();

     if (password_verify($assistPC, $userAssist['passcode'])) {

          $_SESSION['doctorAssistantID'] = $userAssist['doctorAssistantID'];
          $_SESSION['assistFirstName'] = $userAssist['assistFirstName'];
          $_SESSION['assistLastName'] = $userAssist['assistLastName'];
          $_SESSION['assistUN'] = $userAssist['asstUsername'];

          header('location:../views/doctorassistantportal.php');
          exit();
     } else {
       echo "You cannot proceed.";
     }

}
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['doctorAssistantID']);
  unset($_SESSION['assistUN']);
  unset($_SESSION['assistFirstName']);
  unset($_SESSION['assistLastName']);
  header('location:../index.php');
  exit();
}

?>
