<?php


if (!isset($_SESSION)) {
session_start();
}

require "../config/db.php";
require "emailController.php";


$email = "";

$errors = array();

if(isset($_POST['forgot-password'])) {
  $email = $_POST['email'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "This is an invalid email address";
  }
  if (empty($email)) {
    $errors['email'] = "This field is required";
  }


  if (count($errors) === 0) {
    $sql_reset = "SELECT * FROM pediatrician WHERE email=? LIMIT 1";
    $stmt_reset = $conn->prepare($sql_reset);
    $stmt_reset->bind_param("s", $email);
    $stmt_reset->execute();
    $result = $stmt_reset->get_result();
    $user = $result->fetch_assoc();
    $token = $user['ActLinkToken'];
    sendPasswordResetLink($email, $token);
    header('location:../views/password_message.php');
    exit(0);
  }

}


?>
