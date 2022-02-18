<?php

include "../config/db.php";

$postFooterContentTopic = "Footer";
$postFooterContent = "";

$sqlSelectAboutUs = "SELECT posts.*, topic.* FROM posts INNER JOIN topic ON posts.topicID = topic.topicID
                               WHERE topic.topic=?";
$stmtSelectAllAboutUs = $conn->prepare($sqlSelectAboutUs);
$stmtSelectAllAboutUs->bind_param("s", $postFooterContentTopic);
$stmtSelectAllAboutUs->execute();
$result = $stmtSelectAllAboutUs->get_result();
$row = $result->fetch_assoc();

$postFooterContent = $row['posts'];

// var_dump($postFooterContent);


?>
