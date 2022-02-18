<?php


if (!isset($_SESSION)) {
  session_start();
}


include "../config/db.php";


$medRecNo = "";

$patPatientIDFetch = "";

//Fetch data on form
$patFirstNameFetch = "";
$patMiddleNameFetch = "";
$patLastNameFetch = "";
$patMobileNoFetch = "";
$patGuardFirstNameFetch = "";
$patGuardLastNameFetch = "";
$patAgeFetch = "";
$patHeightFetch = "";
$patWeightFetch = "";
$patTempFetch = "";
$patBloodPressureFetch = "";
$patProvFetch = "";
$patCityFetch = "";
$patMedRecNoFetch = "";
$patBrgyFetch = "";
$patStNoFetch = "";
$patStNameFetch = "";

//Variables for updating data on medical record
$patRecNo = "";
$patComplaints = "";
$patDuration = "";
$patTenDx = "";
$patFinDx = "";
$patRecLabEx = "";
$patRecMed = "";
$patDose = "";
$patFamHx = "";
$patComments = "";
$patPrevMeds = "";

$fieldEmptyErrors = array();


$update = false;

if (isset($_GET['recno'])) {
 $medRecNo = $_GET['recno'];

 $sqlstmtrecfetch = "SELECT patients.*, medicalrecord.*, pediatrician.*, province.name AS provName,
                     city.name AS ctyName, street_address.*, barangay.* FROM patients
                     INNER JOIN medicalrecord ON patients.patientsID = medicalrecord.patientsID
                     INNER JOIN pediatrician ON patients.pediaID = pediatrician.pediaID
                     INNER JOIN province ON patients.Prov_ID = province.Prov_ID
                     INNER JOIN city ON patients.cityID = city.cityID
                     INNER JOIN street_address ON patients.streetAddressID = street_address.streetAddressID
                     INNER JOIN barangay ON patients.BrgyID = barangay.BrgyID
                     WHERE medicalrecord.patientsID = ?";
 $stmtrecfetch = $conn->prepare($sqlstmtrecfetch);
 $stmtrecfetch->bind_param("i", $medRecNo);
 $stmtrecfetch->execute();
 $resultfetch = $stmtrecfetch->get_result();
 $rowfetch = $resultfetch->fetch_assoc();

 // dd($sqlstmtrecfetch);

 // echo "<pre>", print_r($rowfetch) , "</pre>";

 $patMedRecNoFetch = $rowfetch['medRecordID'];
 $patPatientIDFetch = $rowfetch['patientsID'];
 $patFirstNameFetch = $rowfetch['patFirstName'];
 $patMiddleNameFetch = $rowfetch['patMiddleName'];
 $patLastNameFetch = $rowfetch['patLastName'];
 $patMobileNoFetch = $rowfetch['mobileNo'];
 $patGuardFirstNameFetch = $rowfetch['guardianFirstName'];
 $patGuardLastNameFetch =  $rowfetch['guardianLastName'];
 $patAgeFetch = $rowfetch['Age'];
 $patHeightFetch = $rowfetch['Height'];
 $patWeightFetch = $rowfetch['Weight'];
 $patTempFetch = $rowfetch['Temperature'];
 $patBloodPressureFetch = $rowfetch['bloodPressure'];
 $patProvFetch = $rowfetch['provName'];
 $patCityFetch = $rowfetch['ctyName'];
 $patBrgyFetch = $rowfetch['BrgyName'];
 $patStNoFetch = $rowfetch['stNo'];
 $patStNameFetch = $rowfetch['stName'];

 $update=true;
}

//FIX FOUND: Patients ID is not being fetched on the form. Record cannot be saved unless the
//patients ID is being fetched. The following lines of code are added.

if (isset($_GET['patientID'])) {
 $medRecNo = $_GET['patientID'];

 $sqlstmtrecfetch = "SELECT patientsID FROM medicalrecord
                     WHERE patientsID = ?";
 $stmtrecfetch = $conn->prepare($sqlstmtrecfetch);
 $stmtrecfetch->bind_param("i", $medRecNo);
 $stmtrecfetch->execute();
 $resultfetch = $stmtrecfetch->get_result();
 $rowfetch = $resultfetch->fetch_assoc();

 $patPatientIDFetch = $rowfetch['patientsID'];

}


if (isset($_POST['update-rec-dr'])) {
   $patRecNo = $_POST['recID'];
   $patComplaints = $_POST['complaint'];
   $patDuration = $_POST['duration'];
   $patTenDx =  $_POST['tenDx'];
   $patFinDx = $_POST['finDx'];
   $patRecLabEx = $_POST['recLabEx'];
   $patRecMed = $_POST['recMed'];
   $patDose = $_POST['dose'];
   $patFamHx =  $_POST['famHis'];
   $patComments = $_POST['comments'];
   $patPrevMeds = $_POST['prevMeds'];


      if (empty($patComplaints)) {
        $fieldEmptyErrors['complaint'] = "Please input your patient's complaints";
      }
      if (empty($patDuration)) {
        $fieldEmptyErrors['duration'] = "Please input your patient's duration of complaints";
      }
      if(empty($patTenDx)) {
        $fieldEmptyErrors['tenDx'] = "Please input your tentative diagnosis for patient";
      }
      // if(empty($patFinDx)) {
      //   $fieldEmptyErrors['finDx'] = "Please input your final diagnosis of patient";
      // }
      if(empty($patRecLabEx)) {
        $fieldEmptyErrors['recLabEx'] = "Please enter laboratory exams to be undergone";
      }
      if (empty($patRecMed)) {
        $fieldEmptyErrors['recMed'] = "Please enter your recommended medications for patient";
      }
      if (empty($patDose)) {
        $fieldEmptyErrors['dose'] = "Please indicate the dosage for the medication of patient";
      }
      if (empty($patFamHx)) {
        $fieldEmptyErrors['famHis'] = "Please specify any family history of any specific illness suffered";
     }
     if (empty($patComments)) {
       $fieldEmptyErrors['comments'] = "Please provide any comment on the patient's situation.";
     }

     if (count($fieldEmptyErrors) == 0) {

         $updateSql = "UPDATE medicalrecord
                       SET complaints=?,
                       duration = ?,
                       previousMeds = ?,
                       tentativeDx = ?,
                       recommendedMeds = ?,
                       dosage=?,
                       recommendedLabExams=?,
                       finalDx=?,
                       famHx=?,
                       comments=?
                       WHERE patientsID=?";
          $stmtUpdate = $conn->prepare($updateSql);
          $stmtUpdate->bind_param("ssssssssssi", $patComplaints, $patDuration, $patPrevMeds, $patTenDx, $patRecMed,
                                   $patDose, $patRecLabEx, $patFinDx, $patFamHx, $patComments, $patRecNo);


          if ($stmtUpdate->execute()) {
              $_SESSION['updateComplete'] = "Diagnosis complete";
          }
          // var_dump($stmtUpdate);

    // header('location:patientsonvisit.php');
  }


}



?>
