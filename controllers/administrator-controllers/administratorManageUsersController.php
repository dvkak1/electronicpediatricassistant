<?php

if (!isset($_SESSION)) {
  session_start();
}


include "../config/db.php";

$pedUserNo = "";
$pedUserFN = "";
$pedUserLN = "";
$pedUserName = "";
$pedUserEmail = "";
$pedPhoneNum = "";
$pedVerified = "";

if (isset($_GET['email'])) {
  $email = $_GET['email'];

  $output_sql_users = "SELECT * FROM pediatrician WHERE email=?";
  $stmt_output_users_modal = $conn->prepare($output_sql_users);
  $stmt_output_users_modal->bind_param("s", $email);
  $stmt_output_users_modal->execute();
  $result = $stmt_output_users_modal->get_result();
  $row_fetch = $result->fetch_assoc();

  $pedUserNo = $row_fetch['pediaID'];
  $pedUserFN = $row_fetch['pedFirstName'];
  $pedUserLN = $row_fetch['pedLastName'];
  $pedUserName = $row_fetch['username'];
  $pedUserEmail = $row_fetch['email'];
  $pedPhoneNum = $row_fetch['mobileNo'];
  $pedVerified = $row_fetch['isApprove'];
}

?>
