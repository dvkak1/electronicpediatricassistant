<?php

include "../config/db.php";

$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

//SELECT ALL FUNCTION with two versions. COMMENT OUT IF YOU WANT TO USE
//Other basic select all function using dd
//Other basic select all function using dd
// function dd($value) {
//   echo "<pre>", print_r($value,true), "</pre>";
// }

function executeQuery($sql, $data)
{
  global $conn;
  $stmt = $conn->prepare($sql);
  $value = array_values($data);
  $type = str_repeat('s', count($value));
  $stmt->bind_param($type, ...$value);
  $stmt->execute();
  // echo "<pre>", print_r($stmt), "</pre>";
  return $stmt;
}

function encryptthis($var, $key) {
$encryption_key = base64_decode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}

function decryptthis($var, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}


function selectDistinct($table, $condition) {
  global $conn;
  $sql = "SELECT DISTINCT * FROM $table";


   $stmt = executeQuery($sql, $condition);
   $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
   return $records;
}

function showAllLocations($condition) {
 global $conn;
 $sqlShow = "SELECT pediatrician.*, specialization.*, clinicpedia.*, clinic.*,street_address.*, city.name AS ctName,
                province.Prov_ID, province.name AS prvName FROM pediatrician INNER JOIN specialization
                ON pediatrician.specializationID = specialization.specializationID
                INNER JOIN clinicpedia ON clinicpedia.pediaID = pediatrician.pediaID
                INNER JOIN clinic ON clinicpedia.clinicID = clinic.clinicID
                INNER JOIN street_address ON street_address.streetAddressID = clinic.streetAddressID
                INNER JOIN city ON city.cityID = street_address.cityID
                INNER JOIN province ON province.Prov_ID = city.Prov_ID
                WHERE specialization.specializationID = ?";

$stmt = executeQuery($sqlShow, $condition);
$locations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
return $locations;


}


function searchPediatricians($condition) {
  global $conn;
  $sql = "SELECT pediatrician.*, specialization.*, clinicpedia.*, clinic.*,street_address.*,
                   city.name AS ctName,
                   province.name AS prvName FROM pediatrician INNER JOIN specialization
                   ON pediatrician.specializationID = specialization.specializationID
                   INNER JOIN clinicpedia ON clinicpedia.pediaID = pediatrician.pediaID
                   INNER JOIN clinic ON clinicpedia.clinicID = clinic.clinicID
                   INNER JOIN street_address ON street_address.streetAddressID = clinic.streetAddressID
                   INNER JOIN city ON city.cityID = street_address.cityID
                   INNER JOIN province ON province.Prov_ID = city.Prov_ID
                   WHERE specialization.specializationID = ?
                   AND province.name LIKE ?
                   OR street_address.stName LIKE ?
                   OR city.name LIKE ?";


 $stmt = executeQuery($sql, $condition);
 $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
 return $records;
}


function selectAll($table, $condition = []) {
  global $conn;
  $sql = "SELECT * FROM $table";
  if(empty($condition)) {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
  } else {
    $i = 0;
    foreach($condition AS $key => $value) {
      if ($i === 0){
          $sql = $sql . " WHERE $key IS NULL OR $key=?";
      } else {
          $sql = $sql . " AND $key=?";
      }
      $i++;
    }
    // dd($sql);
    $stmt = executeQuery($sql, $condition);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
  }
}


function fetchMedRecordwithoutAddress($condition) {
  global $conn;
  $sql = "SELECT patients.*, medicalrecord.* FROM patients
          INNER JOIN medicalrecord ON patients.patientsID = medicalrecord.patientsID";

  $i = 0;
  foreach ($condition AS $key => $value) {
    if ($i === 0) {
    $sql = $sql . " WHERE $key=?";
   } else {
    $sql = $sql . " AND $key=?";
   }
   $i++;
 }

}

// $patients = fetchMedRecordwithoutAddress(['patientsID' => '20']);
// dd($patients);


function searchMedRecord($condition) {
  global $conn;
  $sql = "SELECT patients.*, medicalrecord.*, pediatrician.*, province.name AS provName,
                city.name AS ctyName, street_address.*, barangay.* FROM patients
                INNER JOIN medicalrecord ON patients.patientsID = medicalrecord.patientsID
                INNER JOIN pediatrician ON patients.pediaID = pediatrician.pediaID
                INNER JOIN province ON patients.Prov_ID = province.Prov_ID
                INNER JOIN city ON patients.cityID = city.cityID
                INNER JOIN street_address ON patients.streetAddressID =
                street_address.streetAddressID
                INNER JOIN barangay ON patients.BrgyID = barangay.BrgyID";
                // -- WHERE patFirstName = ?
                // -- AND patMiddleName = ?
                // -- AND patLastName = ?
                // -- AND medicalrecord.isDelete = 0
                // ORDER BY patients.dateSeen ASC";

          $i = 0;
          foreach ($condition AS $key => $value) {
            if ($i === 0) {
              // $sql = $sql . " WHERE $key=?";
              $sql = $sql . " WHERE $key IS NULL OR $key=?";
            } else {
              $sql = $sql . " AND $key=?";
            }
              $i++;
          }

          // $sql = $sql . " ORDER BY patients.dateSeen ASC";
          // dd($sql);
          $stmt = executeQuery($sql, $condition);
          // echo "<pre>", print_r($stmt) , "</pre>";
          $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
          return $records;

}

function searchMedRecordv2($condition) {
  global $conn;
  $sql = "SELECT patients.*, medicalrecord.*, pediatrician.*, province.name AS provName,
                city.name AS ctyName, street_address.*, barangay.* FROM patients
                INNER JOIN medicalrecord ON patients.patientsID = medicalrecord.patientsID
                INNER JOIN pediatrician ON patients.pediaID = pediatrician.pediaID
                INNER JOIN province ON patients.Prov_ID = province.Prov_ID
                INNER JOIN city ON patients.cityID = city.cityID
                INNER JOIN street_address ON patients.streetAddressID =
                street_address.streetAddressID
                INNER JOIN barangay ON patients.BrgyID = barangay.BrgyID";

          $i = 0;
          foreach ($condition AS $key => $value) {
            if ($i === 0) {
              // $sql = $sql . " WHERE $key=?";
              $sql = $sql . " WHERE $key=? AND medicalrecord.isDelete=0";
            } else {
              $sql = $sql . " AND $key=?";
            }
              $i++;
          }

          $sql = $sql . " ORDER BY patients.dateSeen ASC";
          $stmt = executeQuery($sql, $condition);
          $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
          return $records;

}

function searchMedRecordv3($condition) {
  global $conn;
  $sql = "SELECT patients.*, medicalrecord.*, pediatrician.*, province.name AS provName,
                city.name AS ctyName, street_address.*, barangay.* FROM patients
                INNER JOIN medicalrecord ON patients.patientsID = medicalrecord.patientsID
                INNER JOIN pediatrician ON patients.pediaID = pediatrician.pediaID
                INNER JOIN province ON patients.Prov_ID = province.Prov_ID
                INNER JOIN city ON patients.cityID = city.cityID
                INNER JOIN street_address ON patients.streetAddressID =
                street_address.streetAddressID
                INNER JOIN barangay ON patients.BrgyID = barangay.BrgyID";

          $i = 0;
          foreach ($condition AS $key => $value) {
            if ($i === 0) {
              $sql = $sql . " WHERE $key=?";
            } else {
              $sql = $sql . " AND $key=? AND medicalrecord.isDelete=1";
            }
              $i++;
          }

          $sql = $sql . " ORDER BY patients.dateSeen ASC";
          $stmt = executeQuery($sql, $condition);
          $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
          return $records;

}




function selectOne($table, $condition) {
    global $conn;
    $sql = "SELECT * FROM $table";

    $i = 0;
    foreach ($condition AS $key => $value) {
      if ($i === 0) {
        $sql = $sql . " WHERE $key=?";
      } else {
        $sql = $sql . " AND $key=?";
      }
      $i++;
    }

    $sql = $sql . " LIMIT 1";
    $stmt = executeQuery($sql, $condition);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}
// $selectSpecializations = selectOne('specialization', ['specialization_ID' => 15]);
// dd($selectSpecializations);

function selectPediaInfo($condition) {
  global $conn;
  $sql = "SELECT pediatrician.*, clinicpedia.*, clinic.* FROM
          pediatrician INNER JOIN clinicpedia ON pediatrician.pediaID = clinicpedia.pediaID
          INNER JOIN clinic ON clinicpedia.clinicID = clinic.clinicID
          WHERE pediatrician.pediaID =?";

  $stmt = executeQuery($sql, $condition);
  // echo "<pre>", print_r($stmt) , "</pre>";
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;

}

// $showPediaInfo = selectPediaInfo(['pediaID' => '13']);
// dd($showPediaInfo);

function fetchLocationAndSpecialization($condition) {
 global $conn;
 $sqlLocSpec = "SELECT pediatrician.*, specialization.*, clinicpedia.*, clinic.*,street_address.*, city.name AS ctName,
               province.name AS prvName FROM pediatrician INNER JOIN specialization
               ON pediatrician.specializationID = specialization.specializationID
               INNER JOIN clinicpedia ON clinicpedia.pediaID = pediatrician.pediaID
               INNER JOIN clinic ON clinicpedia.clinicID = clinic.clinicID
               INNER JOIN street_address ON street_address.streetAddressID = clinic.streetAddressID
               INNER JOIN city ON city.cityID = street_address.cityID
               INNER JOIN province ON province.Prov_ID = city.Prov_ID
               WHERE province.Prov_ID = ?
               AND specialization.specializationID=? LIMIT 1";

 $stmt = executeQuery($sqlLocSpec, $condition);
 $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
 return $records;
}


//Function for inserting data
function create($table, $data) {
  global $conn;
  $sql = "INSERT INTO $table SET";

      $i = 0;
      foreach ($data AS $key => $value) {
        if ($i === 0) {
          $sql = $sql . " $key=?";
        } else {
          $sql = $sql . ", $key=?";
        }
        $i++;
      }
    // dd($sql);
    $stmt = executeQuery($sql, $data);
    // var_dump($stmt);
    // echo "<pre>", print_r($stmt), "</pre>";
    $id = $stmt->insert_id;
    return $id;
}

//UPDATE FUNCTION
function update($table, $data) {
  global $conn;
  $sql = "UPDATE $table SET ";

  $i = 0;
  foreach($data AS $key => $value){
    if ($i === 0) {
      $sql = $sql . " $key=?";
    } else {
      $sql = $sql . ", $key=?";
    }
    $i++;
  }

  $sql = $sql . " WHERE $key=?";
  dd($sql);
  $stmt = executeQuery($sql, $data);
  echo "<pre>", print_r($stmt),"</pre>";

  // dd($sql);
}

function updatePost($table, $id, $data) {
  global $conn;
  $sql = "UPDATE $table SET ";

  $i = 0;
  foreach($data AS $key => $value){
    if ($i === 0) {
      $sql = $sql . " $key=?";
    } else {
      $sql = $sql . ", $key=?";
    }
    $i++;
  }

  $sql = $sql . " WHERE postsID=?";
  dd($sql);
  $data['postsID'] = $id;
  $stmt = executeQuery($sql, $data);
  echo "<pre>", print_r($stmt),"</pre>";

}

//DELETE FUNCTION

function delete($table, $id) {
  global $conn;
  $sql = "DELETE FROM $table WHERE pediaID=?";

  $stmt= executeQuery($sql, ['pediaID' => $id]);
  return $stmt->affected_rows;
}

function selectAllUsers($condition) {
  global $conn;
  $sql = "SELECT pediatrician.*, specialization.* FROM pediatrician
          INNER JOIN specialization
          ON pediatrician.specializationID = specialization.specializationID";

    $i = 0;
    foreach($condition AS $key => $value){
      if ($i === 0) {
        $sql = $sql . " WHERE $key=?";
      } else {
        $sql = $sql . " AND $key=?";
      }
      $i++;
   }

   $stmt = executeQuery($sql, $condition);
   $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
   return $records;
}

function viewModalContents($condition) {
    global $conn;
    $sql = "SELECT pediatrician.*, hospitalaffiliation.* FROM
            pediatrician INNER JOIN pedia_hosp ON pediatrician.pediaID = pedia_hosp.pediaID
            INNER JOIN hospitalaffiliation ON hospitalaffiliation.hospAfID = pedia_hosp.hospAfID
            WHERE pediatrician.pediaID=?";

   //  $i = 0;
   //  foreach($condition AS $key => $value){
   //   if ($i === 0) {
   //       $sql = $sql . " WHERE $key=?";
   //   } else {
   //       $sql = $sql . " AND  $key=?";
   //   }
   //    $i++;
   // }

   $stmt = executeQuery($sql, $condition);
   $contents = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
   return $contents;
}

function viewAllPostsModerator() {
  global $conn;
  $sql = "SELECT posts.*, topic.* FROM posts
          INNER JOIN topic ON posts.topicID = topic.topicID";

  $stmt = executeQuery($sql, $condition);
  $posts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $posts;

}

function viewHomePageContent($condition) {
 global $conn;
 $sql = "SELECT posts.*, topic.* FROM posts
         INNER JOIN topic ON posts.topicID = topic.topicID";

  $i = 0;
  foreach($condition AS $key => $value){
   if ($i === 0) {
       $sql = $sql . " WHERE $key=?";
   } else {
       $sql = $sql . " AND  $key=?";
   }
    $i++;
  }

  $stmt = executeQuery($sql, $condition);
  $contents = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $contents;
}

// $allPosts = viewAllPostsModerator();
// dd($allPosts);


//Select function with condition ends here
?>
