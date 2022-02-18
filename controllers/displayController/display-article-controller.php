<?php

 error_reporting (E_ERROR | E_PARSE);

if (!isset($_SESSION)) {
  session_start();
}


include "../config/db.php";
// include "../config/db.php";

$article = "";
$articleTitle = "";

$sql_select_article = "SELECT * FROM article";
$stmt_Select_article = $conn->prepare($sql_select_article);
$stmt_Select_article->execute();
$result = $stmt_Select_article->get_result();
$row = $result->fetch_assoc();

$articleTitle = $row['titleOfArticle'];
$article = $row['article'];


?>
