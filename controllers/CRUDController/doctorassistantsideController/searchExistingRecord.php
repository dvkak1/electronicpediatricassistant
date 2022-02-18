<?php

include "../config/db.php";
include "../controllers/functionsFolder/functions.php";


$searchRecs = array();

if (isset($_POST['search-medrec-btn'])) {
  $searchRecs = searchMedRecordv2(['patFirstName' => $_POST['patFirstName'],
                                   'patMiddleName' => $_POST['patMiddleName'],
                                   'patLastName' => $_POST['patLastName']]);

}






?>
