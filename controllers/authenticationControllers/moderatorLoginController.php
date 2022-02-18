<?php

if (!isset($_SESSION)) {
  session_start();
}


include "../config/db.php";



$modUN  = "";
$modPC = "";
$modErrors = array();

$exe = "";

$passcode = "";



if (isset($_POST['moderatorlogin-btn'])) {
   $modUN = $_POST['moderatoruserName'];
   $modPC = $_POST['moderatorPC'];

   if(empty($modUN)){
     $modErrors['moderatoruserName'] = "Please enter your username";
   }
   if(empty($modPC)){
     $modErrors['moderatorPC'] = "Please enter your passcode";
   }

   if(count($modErrors) == 0) {
     $passcode = password_hash($modPC, PASSWORD_ARGON2I);

     $sql_select_moderator = "SELECT * FROM moderator WHERE username=?";
     $stmt_mod = $conn->prepare($sql_select_moderator);
     $stmt_mod->bind_param("s", $modUN);
     $stmt_mod->execute();
     $result = $stmt_mod->get_result();
     $userMod = $result->fetch_assoc();

     if (password_verify($modPC, $userMod['passcode'])) {
       $_SESSION['modID'] = $userMod['moderatorID'];
       $_SESSION['modFirstName'] = $userMod['modFirstName'];
       $_SESSION['modLastName'] = $userMod['modLastName'];
       $_SESSION['modUN'] = $userMod['username'];

       header('location:../views/moderatorportal.php');
       exit();

     }

   }
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['modID']);
  unset($_SESSION['modUN']);
  header('location:../index.php');
  exit();
}


?>
