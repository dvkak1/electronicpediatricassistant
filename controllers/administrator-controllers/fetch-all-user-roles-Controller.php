<?php

if(!isset($_SESSION)){
  session_start();
}

include "../config/db.php";

$row_num = "";
$row_role_name = "";

$sql_show_roles = "SELECT * FROM role";
$stmt_show = $conn->prepare($sql_show_roles);
$stmt_show->execute();
$result = $stmt_show->get_result();
// $rows = $result->fetch_assoc();
    // 
    // while($rows = $result->fetch_assoc()) {
    //   $row_num = $rows['roleID'];
    //   $row_role_name = $rows['roleCategory'];
    // }
?>
