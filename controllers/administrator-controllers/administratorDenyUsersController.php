<?php

if (!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

require_once "../controllers/authenticationControllers/emailController.php";

$sendDenyEmail = "";

if (isset($_POST['deny-dr'])){

  $sendDenyEmail = $_POST['email'];

  SendDisapprovalEmail($sendDenyEmail);
  header("location:adminindex.php");
  exit();
}


?>
