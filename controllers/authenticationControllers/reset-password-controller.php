<?php

if (!isset($_SESSION)) {
session_start();
}

include '../config/db.php';
require_once "../controllers/authenticationControllers/emailController.php";

$newPassword = "";
$newPasswordConf = "";

$errors = array();

if (isset($_POST['reset-password'])) {
$newPassword = $_POST['password'];
$newPasswordConf = $_POST['passwordConf'];

if (empty($newPassword) || empty($newPasswordConf)) {
  $errors['password'] = "Please enter your new password";
}
if ($newPassword !== $newPasswordConf) {
  $errors['password'] = "The two passwords do not match";
}

$newPassword = password_hash($newPassword, PASSWORD_ARGON2I);
$email = $_SESSION['email'];

if (count($errors) == 0) {

    $sql_change = "UPDATE pediatrician SET password=? WHERE email=?";
    $stmt_change = $conn->prepare($sql_change);
    $stmt_change->bind_param("ss", $newPassword, $email);
    $stmt_change->execute();

    if ($result = $stmt_change->store_result()) {
        header('location:../views/signin.php');
    }
}

}



//For changing password
function resetPassword($token)
{
  global $conn;
  $sql_select = "SELECT * FROM pediatrician WHERE ActLinkToken=? LIMIT 1";
  $stmt_select = $conn->prepare($sql_select);
  $stmt_select->bind_param("s", $token);
  $stmt_select->execute();
  $result = $stmt_select->get_result();
  $user = $result->fetch_assoc();
  $_SESSION['email']  = $user['email'];
  // echo $_SESSION['email'];
  // header('location:../views/reset-password.php');
  // exit(0);

}
?>
