<?php

require_once "../controllers/authenticationControllers/loginController.php";

if (!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

$prof_img_name = "";
$prof_img_tmp = "";
$imagesize="";
$profImageUpd = "";
$profImageTmpUpd = "";
$pediaID = $_SESSION['id'];




if (isset($_POST['upload-image'])) {
  $prof_img_name = $_FILES['profileimage']['name'];
  $prof_img_tmp = $_FILES['profileimage']['tmp_name'];

  $upload_folder = "../profile_image/";

  $upload = $upload_folder . $prof_img_name;

  $prof_img_upload_msge = "Image upload complete";
  $prof_img_size_msge = "File size should be between 20KB to 50KB";
  $prof_img_exists_msge = "File exists, please select another file.";
  $prof_img_notfound_msge = "Please select your chosen profile image";

  if (is_uploaded_file($prof_img_tmp)) {
    if (!file_exists($upload_folder.$prof_img_name)){
          $prof_image_size = $_FILES['profileimage']['size'];
      if ($prof_image_size >= 5 && $prof_image_size<=512000) {
        if (move_uploaded_file($prof_img_tmp, $upload)){
          $pediaID = $_SESSION['id'];
          $sql_insert_image = "INSERT INTO pedia_profile(pediaID, prof_image) VALUES (?, ?)";
          $stmt_insert_image  = $conn->prepare($sql_insert_image);
          $stmt_insert_image->bind_param("is", $pediaID, $upload);
          $stmt_insert_image->execute();

          echo $prof_img_upload_msge;
        }
      } else {
        echo $prof_img_size_msge;
      }
    } else {
       echo $prof_img_exists_msge;
    }
  } else {
    echo $prof_img_notfound_msge;
  }
}


if (isset($_POST['update-image'])) {
  $profImageUpd = time() . '_' . $_FILES['profileimage']['name'];
  $profImageTmpUpd = $_FILES['profileimage']['tmp_name'];

  $targetFolderUpd ="../profile_image/" .  $profImageUpd;


  if (move_uploaded_file($profImageTmpUpd, $targetFolderUpd)) {

    $sqlupdateprofimg = "UPDATE pedia_profile SET prof_image=? WHERE pediaID=?";
    $stmtupdateprofimg = $conn->prepare($sqlupdateprofimg);
    $stmtupdateprofimg->bind_param("si", $targetFolderUpd, $pediaID);
    $stmtupdateprofimg->execute();

  }

}


?>
