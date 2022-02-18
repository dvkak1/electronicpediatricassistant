<?php

 error_reporting (E_ERROR | E_PARSE);


include "../config/db.php";


$sql_spec_show = "SELECT * FROM specialization";
$stmt_spec_show = $conn->prepare($sql_spec_show);
$stmt_spec_show->execute();
$result_spec_show = $stmt_spec_show->get_result();



?>
