<?php

if (!isset($_SESSION)) {
session_start();
}

include('../config/db.php');
require 'emailController.php';

$emailuname = "";
$password = "";

$errors = array();

if (isset($_POST['login-btn'])) {
  $emailuname = $_POST['emailuname'];
  $password = $_POST['pword'];

  if (empty($emailuname)) {
    $errors['emailuname'] = "Please input your email or username";
  }
  if (empty($password)){
    $errors['pword'] = "Please enter your password.";
  }

  if (count($errors) === 0){
    $sql_check = "SELECT * FROM pediatrician WHERE email=? OR username=? LIMIT 1";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param("ss", $emailuname, $emailuname);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['pediaID'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['isApprove'] = $user['isApprove'];
        $_SESSION['pedFirstName'] = $user['pedFirstName'];
        $_SESSION['pedLastName'] = $user['pedLastName'];

        if ($_SESSION['isApprove'] == 0) {
          $_SESSION['notVerMessage'] = "You are not yet verified, please click on
          the link sent to " . $_SESSION['email'] . " to verify your account.";
        }

        header('location:../views/privatedoctorportal.php');
        exit();
    } else {
      $errors['login-fail'] = "Wrong credentials";
    }
  }
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['id']);
  unset($_SESSION['username']);
  unset($_SESSION['email']);
  unset($_SESSION['isApprove']);
  header('location:../index.php');
  exit();
}

//Function for verifying new pediatrician by token

function verifyDoctor($token) {
  global $conn;
  $sqlselect = "SELECT * FROM pediatrician WHERE ActLinkToken=? LIMIT 1";
  $stmt = $conn->prepare($sqlselect);
  $stmt->bind_param("s", $token);
  $stmt->execute();
  $result = $stmt->get_result();
  // $result = $stmt->num_rows;

  if($result->num_rows > 0){
    $pedia = $result->fetch_assoc();


    $sqlupdateacc = "UPDATE pediatrician SET isApprove=1 WHERE ActLinkToken=?";
    $stmtupd = $conn->prepare($sqlupdateacc);
    $stmtupd->bind_param("s", $token);

    //If token is verified, allow user to log in and create session
    if ($stmtupd->execute()) {
      $_SESSION['doctorID'] = $pedia['pediaID'];
      $_SESSION['email'] = $pedia['email'];
      $_SESSION['username'] = $pedia['username'];
      $_SESSION['isApprove'] = $pedia['isApprove'];
      $_SESSION['pedFirstName'] = $pedia['pedFirstName'];
      $_SESSION['pedLastName'] = $pedia['pedLastName'];
    }

  } else {
    echo "User not found";
  }
}
// function verifyDoctor($token)
// {
//   global $conn;
//   $sql_verify = "SELECT * FROM pediatrician WHERE ActLinkToken=? LIMIT 1";
//   $stmt = $conn->prepare($sql_verify);
//   $stmt->bind_param("s", $token);
//   $stmt->execute();
//   $stmt->store_result();
//   $result = $stmt->num_rows;
//
//   if ($result > 0) {
//
//     $update_Sql = "UPDATE pediatrician SET isApprove=1 WHERE ActLinkToken=?";
//     $stmt_update = $conn->prepare($update_Sql);
//     $stmt_update->bind_param("s", $token);
//
//     if($stmt_update->execute()){
//       $_SESSION['id'] = $user['pediaID'];
//       $_SESSION['email'] = $user['email'];
//       $_SESSION['username'] = $user['username'];
//       $_SESSION['isApprove'] = 1;
//
//       header('location:../views/signin.php');
//       exit();
//     }
//   } else {
//     // echo "No user found";
//   }
// }
//


?>
