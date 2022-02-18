<?php

include "../config/db.php";

include "../controllers/functionsFolder/functions.php";

include "../inputValidators/validateInputs.php";

session_start();

$pErr = array();

$gender = "";

$drAsstID = $_SESSION['doctorAssistantID'];

if (isset($_POST['create-rec'])) {
  $pErr = validateCRUDInputs($_POST);

  if (count($pErr) === 0) {
  $provinces  = selectOne('province', ['name' => $_POST['patientProv']]);
  $cities = selectOne('city', ['name' => $_POST['patientCity']]);
  $brgys = selectOne('barangay', ['BrgyName' => $_POST['BrgyName']]);
  $stAdds = selectOne('street_address', ['stNo' => $_POST['patientStNo'],
                                           'stName' => $_POST['patientStAddress']]);

    if (isset($provinces) && isset($cities) && isset($brgys) && isset($stAdds)){

      $provinceID = create('province', ['name' => $_POST['patientProv']]);
      $cityID = create('city', [
                                'Prov_ID' => $provinceID,
                                'name' => $_POST['patientCity']]);
      $brgyID = create('barangay', ['cityID' => $cityID,
                                    'BrgyName' => $_POST['BrgyName']]);
      $stAddID = create('street_address', [
                                           'cityID' => $cityID,
                                           'stNo' => $_POST['patientStNo'],
                                           'stName' => $_POST['patientStAddress']]);


      $pediaID = selectOne('pediatrician', ['pedFirstName' => $_POST['drFirstName'],
                                            'pedLastName' => $_POST['drLastName']]);

      foreach($pediaID AS $pID) {
        $pediatricianID = $pID['pediaID'];
      }

      if(isset($_POST['gender']) == 'M') {
        $gender = 0;
      } elseif (isset($_POST['gender']) == 'F') {
        $gender = 1;
      }



      $patientID = create('patients', [
                                     'pediaID' => $pediatricianID,
                                     'doctorAssistantID' => $drAsstID,
                                     'Prov_ID' => $provinceID,
                                     'cityID' => $cityID,
                                     'BrgyID' => $brgyID,
                                     'streetAddressID' => $stAddID,
                                     'patFirstName' => $_POST['patFirstName'],
                                     'patMiddleName' => $_POST['patMidName'],
                                     'patLastName' => $_POST['patLastName'],
                                     'gender' => $gender,
                                     'birthdate' => $_POST['bdate'],
                                     'mobileNo' => $_POST['pedMobNo'],
                                     'guardianFirstName' => $_POST['guardFirstName'],
                                     'guardianLastName' => $_POST['guardLastName']]);

      $medRecID = create('medicalrecord', ['patientsID' => $patientID,
                                           'pediaID' => $pediatricianID,
                                           'doctorAssistantID' => $drAsstID,
                                           'Age' => $_POST['patientAge'],
                                           'Height' => $_POST['patientHeight'],
                                           'Weight'=> $_POST['patientWeight'],
                                           'Temperature' => $_POST['patientTemp'],
                                           'bloodPressure' => $_POST['patientBloodPressure']
                                             ]);
    } else {

      foreach($provinces AS $province) {
       $province_id = $provinces['Prov_ID'];
      }

      foreach($cities AS $cityExist) {
       $city_id = $cityExist['cityID'];
      }

      foreach($brgys AS $brgyExist) {
        $brgy_id = $brgyExist['BrgyID'];
      }

      foreach($stAdds AS $stAddExist) {
        $stAdd_id = $stAddExist['streetAddressID'];
      }

      $pediaExistIDs = selectOne('pediatrician', ['pedFirstName' => $_POST['drFirstName'],
                                            'pedLastName' => $_POST['drLastName']]);

      foreach($pediaExistsIDs AS $pediaExistID) {
        $pediatricianExistID = $pediaExistID['pediaID'];
      }

      if(isset($_POST['gender']) == 'M') {
        $gender = 0;
      } elseif (isset($_POST['gender']) == 'F') {
        $gender = 1;
      }


      $existPatientID = create('patients', [
                                     'pediaID' => $pediatricianID,
                                     'doctorAssistantID' => $drAsstID,
                                     'Prov_ID' => $provinceID,
                                     'cityID' => $cityID,
                                     'BrgyID' => $brgyID,
                                     'streetAddressID' => $stAddID,
                                     'patFirstName' => $_POST['patFirstName'],
                                     'patMiddleName' => $_POST['patMidName'],
                                     'patLastName' => $_POST['patLastName'],
                                     'gender' => $gender,
                                     'birthdate' => $_POST['bdate'],
                                     'mobileNo' => $_POST['pedMobNo'],
                                     'guardianFirstName' => $_POST['guardFirstName'],
                                     'guardianLastName' => $_POST['guardLastName']]);

      $medRecExist = create('medicalrecord', ['patientsID' => $existPatientID,
                                                'pediaID' => $pediaExistID,
                                                'doctorAssistantID' => $drAsstID,
                                                'Age' => $_POST['patientAge'],
                                                'Height' => $_POST['patientHeight'],
                                                'Weight'=> $_POST['patientWeight'],
                                                'Temperature' => $_POST['patientTemp'],
                                                'bloodPressure' => $_POST['patientBloodPressure']
                                              ]);
    }
 }
  // dd($_POST);
}



?>
