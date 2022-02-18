<?php

include "../config/db.php";
include "../controllers/functionsFolder/functions.php";

$topicID = "";
$postContent = "";

if (isset($_GET['postno'])) {
  $selectPosts = selectOne('posts', ['postsID' => $_GET['postno']]);

  foreach($selectPosts AS $selectPost) {
    $postID = $selectPost['postsID'];
    // $topicID = $selectPost['topicID'];
    $postContent = $selectPost['posts'];
  }
}

if (isset($_POST['update-post'])) {
  $selectTopics = selectOne('topic' , ['topic' => $_POST['topic']]);

  foreach($selectTopics AS $selectTopic) {
    $topicID = $selectTopic['topicID'];
  }

  $updatePost = updatePost('posts', $_POST['postID'], ['topicID' => $topicID,
                                                       'posts' => $_POST['post']]);
}



?>
