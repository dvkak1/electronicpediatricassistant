<?php

include "../config/db.php";

$labID = "";
$comment = "";

if(isset($_POST['add-comment'])) {
  $labID = $_POST['labResID'];
  $comment = $_POST['lab-comment'];

  $sqlinsertcomment = "UPDATE laboratoryresults SET comments=? WHERE labResultID=?";
  $stmtinsertcomment = $conn->prepare($sqlinsertcomment);
  $stmtinsertcomment->bind_param("si", $comment, $labID);
  $stmtinsertcomment->execute();
}


?>
