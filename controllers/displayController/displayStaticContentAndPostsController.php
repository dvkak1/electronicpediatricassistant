<?php

if (!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

$articleTitle = "";
$article = "";
$articleNo = "";

$sql_show_article = "SELECT * FROM article";
$stmt_show = $conn->prepare($sql_show_article);
$stmt_show->execute();
$result = $stmt_show->get_result();
// $row = $result->fetch_assoc();
// 
// while ($row = $result->fetch_assoc()) {
//   $articleNo = $row['articleID'];
//   $articleTitle = $row['titleOfArticle'];
//   $article = $row['article'];
// }

?>
