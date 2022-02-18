<?php


// if (!isset($_SESSION)) {
  session_start();
// }

include "../config/db.php";

include "../controllers/functionsFolder/functions.php";

$postTopicID = "";

if (isset($_POST['enter-post'])) {
  $selectTopics = selectOne('topic', ['topic' => $_POST['topic']]);

  if(isset($selectTopics)) {
    $topic = create('topic', ['topic' => $_POST['topic']]);

    $createPost = create('posts', ['topicID' => $topic,
                                  'posts' => $_POST['post']
                                 ]);
  } else {
    foreach($selectTopics AS $selectTopic) {
     $postTopicID = $selectTopic['topicID'];
    }

    $createPostExistingTopic = create('posts', ['topicID' => $postTopicID,
                                               'posts' => $_POST['topic']
                                              ]);
  }

}

?>
