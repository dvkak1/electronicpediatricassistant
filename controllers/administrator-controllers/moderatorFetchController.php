  <?php

  if (!isset($_SESSION)) {
    session_start();
  }


  include "../config/db.php";

  $modFirstName = "";
  $modMiddleName = "";
  $modLastName = "";
  $modEmail = "";
  $modPassword = "";
  $modPasswordConf = "";
  $modPattern =  '/[^a-z\s]/i';
  $modErrors = array();

  $modFirstName = "";
  $modMiddleName = "";
  $modLastName = "";
  $modEmail = "";


  $sql_showall_mods = "SELECT * FROM moderator";
  $stmt_showall = $conn->prepare($sql_showall_mods);
  $stmt_showall->execute();
  $result = $stmt_showall->get_result();

  ?>
