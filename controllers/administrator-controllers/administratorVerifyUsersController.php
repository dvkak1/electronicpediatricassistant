<?php
require_once "../controllers/authenticationControllers/emailController.php";

$sendApproveEmail = "";
$sendApproveToken = "";

if (isset($_POST['approve-dr'])) {
  $sendApproveEmail = $_POST['email'];
  $sendApproveToken = $_POST['token'];


  sendVerificationEmail($sendApproveEmail, $sendApproveToken);
  header('location:adminindex.php');
  exit();

}
?>
