<?php

 error_reporting (E_ERROR | E_PARSE);

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";
// include "../config/db.php";

$show_Var = "";
// $assistantVar = "";
// $patientVar = "";

$sql_select_user_control = "SELECT * FROM role WHERE status=1";
$stmt_select = $conn->prepare($sql_select_user_control);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

//
// while ($row = $result_select->fetch_assoc()) {
//
// $show_Var = $row['roleLink'];
//
// }




?>
