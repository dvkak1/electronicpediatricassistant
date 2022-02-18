<?php

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

if(isset($_GET['restore'])) {
  $restore = $_GET['restore'];
}

$sql_restore_user_role = "UPDATE role SET status=1 WHERE roleID=?";
$stmt_Restore = $conn->prepare($sql_restore_user_role);
$stmt_Restore->bind_param("i", $restore);
$stmt_Restore->execute();

// header("location:../views/rolemanagement.php");
// exit();

?>
