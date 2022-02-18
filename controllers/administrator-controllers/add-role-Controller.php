<?php

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

$user_role = "";
$errorRole = array();

if(isset($_POST['add-role'])) {
 $user_role = $_POST['user-role'];

 if (empty($user_role)) {
   $errorRole['user-role'] = "Please input user role";
 }

 $sql_select_existing_role = "SELECT * FROM role WHERE roleCategory=? LIMIT 1";
 $stmt_select_role = $conn->prepare($sql_select_existing_role);
 $stmt_select_role->bind_param("s", $user_role);
 $stmt_select_role->execute();
 $result = $stmt_select_role->get_result();
 $role_count = $result->num_rows;
 $stmt_select_role->close();

 if ($role_count > 0) {
   $errorRole['user-role'] = "This role is already existing";
 }


    if (count($errorRole) === 0 ) {
     $sql_insert_role = "INSERT INTO role(roleCategory) VALUES (?)";
     $stmt = $conn->prepare($sql_insert_role);
     $stmt->bind_param("s", $user_role);
     $stmt->execute();
   }
   // else {
   //   echo "This role already exists";
   // }


}

?>
