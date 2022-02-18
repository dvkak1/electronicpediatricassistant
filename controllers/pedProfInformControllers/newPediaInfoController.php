<?php

if (!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";
require_once "../controllers/authenticationControllers/loginController.php";


$pedProv = "";
$pedCity = "";
$pedStAdd = "";
$pedstNum = "";
$pedBrgy = "";
$pedPedID = $_SESSION['id'];
$pedClinic = "";
$pedServ = "";
$emptyPedErrs = array();

if (isset($_POST['add-info'])) {
   $pedProv = $_POST['prov'];
   $pedCity = $_POST['city'];
   $pedBrgy = $_POST['brgy'];
   $pedStAdd = $_POST['stAdd'];
   $pedStNum = $_POST['stNo'];
   $pedClinic = $_POST['clinic'];
   $pedServ = $_POST['services'];

   if (empty($pedProv)) {
     $emptyPedErrs['prov']  = "Please enter your province";
   }
   if (empty($pedCity)) {
     $emptyPedErrs['city'] = "Please enter your city of residence";
   }
   if (empty($pedBrgy)){
     $emptyPedErrs['brgy'] = "Please enter your barangay";
   }
   if (empty($pedStAdd)) {
     $emptyPedErrs['stAdd'] = "Please enter your street address";
   }
   if (empty($pedStNum)) {
     $emptyPedErrs['stNum'] = "Please enter your number of your street address";
   }
   if (empty($pedClinic)) {
     $emptyPedErrs['clinic'] = "Please enter the clinic you work in.";
   }
   if(empty($pedServ)) {
     $emptyPedErrs['services'] = "Please enter the services you offer";
   }


   if (count($emptyPedErrs) == 0) {
     $sqlselectprov = "SELECT Prov_ID FROM province WHERE name=?";
     $stmtselectprov = $conn->prepare($sqlselectprov);
     $stmtselectprov->bind_param("s", $pedProv);
     $stmtselectprov->execute();
     $stmtselectprov->store_result();

     if($stmtselectprov->num_rows == 0) {
       $sqlinsertprov = "INSERT INTO province(name) VALUES(?)";
       $stmtinsertprov = $conn->prepare($sqlinsertprov);
       $stmtinsertprov->bind_param("s", $pedProv);

       if($stmtinsertprov->execute()) {
         $prov_ID = $conn->insert_id;

         $stmtinsertcity = "INSERT INTO city(Prov_ID, name) VALUES (?, ?)";
         $stmtinsertcity = $conn->prepare($stmtinsertcity);
         $stmtinsertcity->bind_param("is", $prov_ID, $pedCity);

       }
     } else {
       $stmtselectprov->bind_result($pedProvExistID);
       $stmtselectprov->fetch();

       $sqlinsertcityexistProv = "INSERT INTO city(Prov_ID, name) VALUES (?, ?)";
       $stmt = $conn->prepare($sqlinsertcityexistProv);
       $stmt->bind_param("is", $pedProvExistID, $pedCity);
       $stmt->execute();

       $prov_ID = $conn->insert_id;
     }

     $sqlselcity = "SELECT cityID FROM city WHERE name=?";
     $stmtselcity = $conn->prepare($sqlselcity);
     $stmtselcity->bind_param("s", $pedCity);
     $stmtselcity->execute();
     $stmtselcity->store_result();

     if ($stmtselcity->num_rows == 0){

       $sqlinsertcity = "INSERT INTO city(Prov_ID, name) VALUES(?, ?)";
       $stmtcity = $conn->prepare($sqlinsertcity);
       $stmtcity->bind_param("is", $prov_ID, $pedCity);

       if($stmtcity->execute()) {
         $city_ID = $conn->insert_id;

         $sqlinsertstAdd = "INSERT INTO street_address(cityID, stName, stNo) VALUES (?, ?, ?)";
         $stmt = $conn->prepare($sqlinsertstAdd);
         $stmt->bind_param("isi", $city_ID, $pedStAdd, $pedStNum);
         $stmt->execute();

         $sqlinsertBrgy = "INSERT INTO barangay(cityID, BrgyName) VALUES (?, ?)";
         $stmtbrgy = $conn->prepare($sqlinsertBrgy);
         $stmtbrgy->bind_param("is", $city_ID, $pedBrgy);
         $stmtbrgy->execute();


       }
     } else {
       $stmtselcity->bind_result($pedCityExistID);
       $stmtselcity->fetch();

       $sqlinsertcityExiststAdd = "INSERT INTO street_address(cityID, stName, stNo) VALUES (?, ?, ?)";
       $stmtinsertstAddExist = $conn->prepare($sqlinsertcityExiststAdd);
       $stmtinsertstAddExist->bind_param("isi", $pedCityExistID, $pedStAdd, $pedStNum);
       $stmtinsertstAddExist->execute();


       $sqlinsertBrgyExists = "INSERT INTO barangay(cityID, BrgyName) VALUES (?, ?)";
       $stmtbrgyEx = $conn->prepare($sqlinsertBrgyExists);
       $stmtbrgyEx->bind_param("is", $pedCityExistID, $pedBrgy);
       $stmtbrgyEx->execute();


     }

     $sqlselectclinic = "SELECT clinicID FROM clinic WHERE name=?";
     $stmtclinic = $conn->prepare($sqlselectclinic);
     $stmtclinic->bind_param("s", $pedClinic);
     $stmtclinic->execute();
     $stmtclinic->store_result();

     if($stmtclinic->num_rows == 0) {

      $streetAddress_ID = $conn->insert_id;

      $sqlinsertclinic = "INSERT INTO clinic(streetAddressID, name) VALUES (?, ?)";
      $stmtclinicNoEx = $conn->prepare($sqlinsertclinic);
      $stmtclinicNoEx->bind_param("is", $streetAddress_ID, $pedClinic);

      if ($stmtclinicNoEx->execute()){
       $clinic_ID = $conn->insert_id;
       $sqlinsertclinicpedia = "INSERT INTO clinicpedia(clinicID, pediaID) VALUES (?, ?)";
       $stmtclinicpedia = $conn->prepare($sqlinsertclinicpedia);
       $stmtclinicpedia->bind_param("ii", $clinic_ID, $pedPedID);
       $stmtclinicpedia->execute();
      }
     } else {
      $stmtclinic->bind_result($clinicExistID);
      $stmtclinic->fetch();

      $sqlinsertclinicExistpedia = "INSERT INTO clinicpedia(clinicID, pediaID) VALUES (?, ?)";
      $stmtclinicExist = $conn->prepare($sqlinsertclinicExistpedia);
      $stmtclinicExist->bind_param("ii", $clinicExistID, $pedPedID);
      $stmtclinicExist->execute();
     }

     $sqlselectservice = "SELECT serviceID FROM services WHERE serviceType=?";
     $stmtservice = $conn->prepare($sqlselectservice);
     $stmtservice->bind_param("s", $pedServ);
     $stmtservice->execute();
     $stmtservice->store_result();

     if($stmtservice->num_rows == 0){
       $sqlinsertservice = "INSERT INTO services(serviceType) VALUES(?)";
       $stmtinsertservice = $conn->prepare($sqlinsertservice);
       $stmtinsertservice->bind_param("s", $pedServ);

       if($stmtinsertservice->execute()) {
         $service_ID = $conn->insert_id;
         $sqlpedservice = "INSERT INTO pediaservice(serviceID, pediaID) VALUES(?, ?)";
         $stmtinsertpedservice = $conn->prepare($sqlpedservice);
         $stmtinsertpedservice->bind_param("ii", $service_ID, $pedPedID);
         // $stmtinsertpedservice->execute();

         if ($stmtinsertpedservice->execute()) {
          $_SESSION['infoPedia']  = "Information provided";
         }
       }

     } else {
       $stmtservice->bind_result($serviceExistID);
       $stmtservice->fetch();

       $sqlinsertpedserviceExist = "INSERT INTO pediaservice(serviceID, pediaID) VALUES (?, ?)";
       $stmtinsertpedServ = $conn->prepare($sqlinsertpedserviceExist);
       $stmtinsertpedServ->bind_param("ii", $serviceExistID, $pedPedID);

      if ($stmtinsertpedServ->execute()) {
        $_SESSION['infoPedia'] = "Information provided";
      }
     }

   }

}
?>
