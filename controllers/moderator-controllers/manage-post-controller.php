<?php

if(!isset($_SESSION)) {
  session_start();
}

include "../config/db.php";

$article_ID = "";
$article = "";
$articleTitle_Form = "";
$articleNumber = "";
//
// $newPost = "";
// $newPostTitle = "";
$articleNo = "";

$delete_PostID = "";

$update_post = false;

if (isset($_GET['post-id'])) {
$pID = $_GET['post-id'];

$sql_echo_posts = "SELECT * FROM article WHERE articleID = ?";
$stmt_echo_posts = $conn->prepare($sql_echo_posts);
$stmt_echo_posts->bind_param("i", $pID);
$stmt_echo_posts->execute();
$result_post = $stmt_echo_posts->get_result();
$row_post = $result_post->fetch_assoc();

$article_ID = $row_post['articleID'];
$articleTitle_Form = $row_post['titleOfArticle'];
$article = $row_post['article'];



$update_post = true;

}

if (isset($_POST['update-post-btn'])) {
  $new_articleTitle = $_POST['post-title'];
  $new_article = $_POST['post'];
  $articleNumber = $_POST['post-id'];

  $sql_update_post = "UPDATE article SET article=?, titleOfArticle=?
                      WHERE articleID=?";
  $stmt_update = $conn->prepare($sql_update_post);
  $stmt_update->bind_param("ssi", $new_article, $new_articleTitle, $articleNumber);
  $stmt_update->execute();

}

if(isset($_POST['delete-post-btn'])) {
$delete_PostID = $_POST['post-id'];

$sql_Delete = "DELETE FROM article WHERE articleID = ?";
$stmt_delete = $conn->prepare($sql_Delete);
$stmt_delete->bind_param("i", $delete_PostID);
$stmt_delete->execute();
}

?>
