<?php

if (isset($_SESSION)){
  session_start();
}

include "../config/db.php";

if (isset($_GET['email'])) {
  $email_deactivate = $_GET['email'];
}


$sql_update_deactivate = "UPDATE pediatrician SET isApprove=0 WHERE email=?";
$stmt_update_deactivate = $conn->prepare($sql_update_deactivate);
$stmt_update_deactivate->bind_param("s", $email_deactivate);
$stmt_update_deactivate->execute();

header("location:../views/admin-users.php");

?>
