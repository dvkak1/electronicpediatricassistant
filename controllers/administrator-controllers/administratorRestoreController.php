<?php

if(!isset($_SESSION)){
  session_start();
}

include "../config/db.php";

if(isset($_GET['email'])) {
  $email_2 = $_GET['email'];
}

$sql_update_reactivate = "UPDATE pediatrician SET isApprove=1 WHERE email=?";
$stmt_update_reactivate = $conn->prepare($sql_update_reactivate);
$stmt_update_reactivate->bind_param("s", $email_2);
$stmt_update_reactivate->execute();

header("location:../views/admin-users.php");


?>
