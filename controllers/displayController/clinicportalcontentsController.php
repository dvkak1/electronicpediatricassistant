<?php

if (!isset($_SESSION)) {
  session_start();
}


include "../config/db.php";

if(isset($_GET['clinic'])) {
  $clID = $_GET['clinic'];
}

  $sql_show_clinic_info = "SELECT pediatrician.* , clinic.name AS clName , clinicpedia.*, street_address.*, city.*,
                            province.name AS pvN FROM
                            pediatrician INNER JOIN clinicpedia ON pediatrician.pediaID = clinicpedia.pediaID
                            INNER JOIN clinic ON clinicpedia.clinicID = clinic.clinicID
                            INNER JOIN street_address ON clinic.streetAddressID = street_address.streetAddressID
                            INNER JOIN city ON street_address.cityID = city.cityID
                            INNER JOIN province ON city.Prov_ID = province.Prov_ID
                            WHERE clinic.clinicID = ?";
  $stmt_show_clinic = $conn->prepare($sql_show_clinic_info);
  $stmt_show_clinic->bind_param("i", $clID);
  $stmt_show_clinic->execute();
  $result = $stmt_show_clinic->get_result();



?>
