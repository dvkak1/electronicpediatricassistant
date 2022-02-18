<?php

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

if(isset($_GET['delete'])) {
  $delete = $_GET['delete'];
}

$sql_delete_user_role = "UPDATE role SET status=0 WHERE roleID=?";
$stmt_delete = $conn->prepare($sql_delete_user_role);
$stmt_delete->bind_param("i", $delete);
$stmt_delete->execute();
// 
// header("location:../views/rolemanagement.php");
// exit();


?>
