<?php

session_start();

include("../config/db.php");
require "emailController.php";

include "../controllers/functionsFolder/functions.php";


//Variables for textbox values of Registration form
$pedFirstName = "";
$pedMiddleName = "";
$pedLastName = "";
$pedEmail = "";
$mobileNo = "";
$pedPWord = "";
$pedPWordConf = "";
$pedBDate = "";
$pedGender = "";
$pedSpec = "";
$peduname = "";
$pedHospAf = "";

//For echoing session message after registration
$username = "";
$email = "";
$dateReg = "";

//For checking alphabetic characters and spaces
$pattern =  '/[^a-z\s]/i';

//Variable used for validating inputs
$errors = array();

if (isset($_POST['reg-btn'])) {

//Initialized variables with data to be inputted by registering pediatrician
$pedFirstName = $_POST['firstName'];
$pedMiddleName = $_POST['middleName'];
$pedLastName = $_POST['lastName'];
$mobileNo = $_POST['mobileNo'];
$pedGender = $_POST['gender'];
$peduname = $_POST['username'];
$pedEmail = $_POST['email'];
$pedPWord = $_POST['pword'];
$pedPWordConf = $_POST['confpWord'];
$pedBDate = $_POST['bdate'];
$pedSpec = $_POST['pedSpecialization'];
$pedHospAf = $_POST['pedHospitalAf'];

//Validators for information being inputted by registering pediatrician
 if (empty($peduname)) {
   $errors['username'] = "Please enter your username";
 }
 if (empty($pedEmail)) {
   $errors['pedEmail'] = "Please enter your email";
 }
 if (empty($pedFirstName)) {
   $errors['firstName'] = "Please enter your first name";
 }
 if (empty($pedMiddleName)) {
   $errors['middleName'] = "Please enter your middle name";
 }
 if (empty($pedLastName)) {
   $errors['lastName'] = "Please enter your last name";
 }
 if (empty($pedHospAf)) {
   $errors['pedHospitalAf'] = "Please enter your hospital affiliaton";
 }
 if (empty($pedGender)) {
   $errors['gender'] = "Please enter your gender";
 }
 if (empty($pedSpec)) {
   $errors['pedSpecialization'] = "Please specify your specialization.";
 }
 if (empty($pedBDate)) {
   $errors['bdate'] = "Please enter your birthdate";
 }
 if (empty($pedPWord)) {
   $errors['pword'] = "Please enter your password";
 }
 if (empty($pedPWordConf)) {
   $errors['confpword'] = "Please confirm your password";
 }
 if ($pedPWord != $pedPWordConf) {
   $errors['pword'] = "The passwords do not match, please try again.";
 }
 if (empty($mobileNo)) {
   $errors['mobileNo'] = "Please confirm your mobile number.";
 }

 //For selecting if email already exists
 $sqlselemail = "SELECT email FROM pediatrician WHERE email= ? LIMIT 1";
 $stmt = $conn->prepare($sqlselemail);
 $stmt->bind_param("s", $pedEmail);
 $stmt->execute();
 $result = $stmt->get_result();
 $userCount = $result->num_rows;

 if ($userCount > 0) {
  $errors['email'] = "This email already exists";
 }


 if (count($errors) === 0) {
   $drEncPW  = password_hash($pedPWord, PASSWORD_ARGON2I);
   $email = encryptthis($pedEmail, $key);
   $username = encryptthis($peduname, $key);
   $regToken = bin2hex(random_bytes(50));
   $approved = false;




   //For selecting if specialization already exists
   $sqlselspec = "SELECT specializationID FROM specialization WHERE specialization_name = ? LIMIT 1";
   $stmt = $conn->prepare($sqlselspec);
   $stmt->bind_param("s", $pedSpec);
   $stmt->execute();
   $stmt->store_result();


   //If specialization does not exists
   if ($stmt->num_rows == 0) {
     $sqlinsertspec = "INSERT INTO specialization(specialization_name) VALUES
                       (?)";
     $stmt= $conn->prepare($sqlinsertspec);
     $stmt->bind_param("s", $pedSpec);

     //If prepared statement for specialization insertion is triggered
     if ($stmt->execute()) {
       $specialization_ID = $conn->insert_id;

       $sqlinsertpedia = "INSERT INTO pediatrician(specializationID, pedFirstName,
                          pedMiddleName, pedLastName, gender, birthdate, email, username,
                          mobileNo, password, ActLinkToken, isApprove)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
       $stmt = $conn->prepare($sqlinsertpedia);
       $stmt->bind_param("issssssssssi", $specialization_ID, $pedFirstName, $pedMiddleName,
                                    $pedLastName, $pedGender, $pedBDate, $pedEmail, $peduname, $mobileNo, $drEncPW,
                                     $regToken, $approved);
       // $stmtinsertpedia->execute();
       // $pedia_ID = $conn->insert_id;
     }
   //If specialization already exists, this code is triggered
   } else {
    $stmt->bind_result($specexistID);
    $stmt->fetch();

    $sqlinsertpedia = "INSERT INTO pediatrician(specializationID, pedFirstName,
                       pedMiddleName, pedLastName, gender, birthdate, email, username,
                       mobileNo, password, ActLinkToken, isApprove)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlinsertpedia);
    $stmt->bind_param("issssssssssi", $specexistID, $pedFirstName, $pedMiddleName,
                                 $pedLastName, $pedGender, $pedBDate, $pedEmail, $peduname, $mobileNo, $drEncPW,
                                  $regToken, $approved);
    // $stmtinsertpedia2->execute();
   }

   //For selecting if hospital affiliation already exists
   $sqlselspec = "SELECT hospAfID FROM hospitalaffiliation WHERE hospitalName = ? LIMIT 1";
   $stmt = $conn->prepare($sqlselspec);
   $stmt->bind_param("s", $pedSpec);
   $stmt->execute();
   $stmt->store_result();

   //If Hospital Affilation does not exist
   if ($stmt->num_rows == 0) {
     $sqlinserthospAf =  "INSERT INTO hospitalaffiliation(hospitalName) VALUES (?)";
     $stmt = $conn->prepare($sqlinserthospAf);
     $stmt->bind_param("s", $pedHospAf);

     if ($stmt->execute()) {
       $hospAf_ID = $conn->insert_id;

       $sqlinsertpedia3 = "INSERT INTO pediatrician(specializationID, pedFirstName,
                          pedMiddleName, pedLastName, gender, birthdate, email, username, mobileNo,
                          password, ActLinkToken, isApprove)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
       $stmt = $conn->prepare($sqlinsertpedia3);
       $stmt->bind_param("issssssssssi", $specexistID, $pedFirstName, $pedMiddleName,
                                    $pedLastName, $pedGender, $pedBDate, $pedEmail, $peduname, $mobileNo, $drEncPW,
                                    $regToken, $approved);

       if ($stmt->execute()) {
         $pedia_ID = $conn->insert_id;

         $sqlinserttopedhosp = "INSERT INTO pedia_hosp(pediaID, hospAfID) VALUES (?, ?)";
         $stmt = $conn->prepare($sqlinserttopedhosp);
         $stmt->bind_param("ii", $pedia_ID, $hospAf_ID);
       }
     }
   } else {
     $stmt->bind_result($hospAfexistID);
     $stmt->fetch();

     $sqlinsertpedia4 = "INSERT INTO pediatrician(specializationID, pedFirstName,
                        pedMiddleName, pedLastName, gender, birthdate, email, username, mobileNo,
                        password, ActLinkToken, isApprove)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
     $stmt = $conn->prepare($sqlinsertpedia4);
     $stmt->bind_param("issssssssssi", $specexistID, $pedFirstName, $pedMiddleName,
                                  $pedLastName, $pedGender, $pedBDate, $pedEmail, $peduname, $mobileNo, $drEncPW,
                                  $regToken, $approved);

      if ($stmt->execute()) {
        $pedia_ID2 = $conn->insert_id;

        $sqlinserttopedhosp2 = "INSERT INTO pedia_hosp(pediaID, hospAfID) VALUES (?, ?)";
        $stmt = $conn->prepare($sqlinserttopedhosp2);
        $stmt->bind_param("ii", $pedia_ID2, $hospAfexistID);
      }
   }



   if(($stmt->execute())) {
     //If all credentials are valid
     $pedia_id = $conn->insert_id;
     $_SESSION['id'] = $pedia_id;
     $_SESSION['email'] = $sessionEmail;
     $_SESSION['dateRegistered'] = $sessionDate;
     date_default_timezone_set('Asia/Manila');
     $sessionDate = date('M-d Y l h:i:s A');

     $_SESSION['regMessage'] = "You have successfully registered on ". $sessionDate . "<br>" .
                                "We will send you an email verification link as soon as your credentials
                                are verified.";
     header("location:../views/register.php");
     exit();

 }

}
}
?>
