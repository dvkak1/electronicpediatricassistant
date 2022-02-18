<?php

include "../config/db.php";

$postAboutUs = "";
$postAboutUsTopic1 = "About us";
$postAboutUsContentTopic1 = "13";
$postAboutUsContentTopic2 = "15";
$postAboutUsContentTopic3 = "16";
$postAboutUsDisplayTopic = "";
$displaypostAboutUsContentTopic1 = "";
$postAboutUsContent1 = "";
$displaypostAboutUsContentTopic2 = "";
$postAboutUsContent2 = "";
$displaypostAboutUsContentTopic3 = "";
$postAboutUsContent3 = "";
$postAboutUsContent = "";

$sqlSelectAboutUs = "SELECT posts.*, topic.* FROM posts INNER JOIN topic ON posts.topicID = topic.topicID
                               WHERE topic=?";
$stmtSelectAllAboutUs = $conn->prepare($sqlSelectAboutUs);
$stmtSelectAllAboutUs->bind_param("s", $postAboutUsTopic1);
$stmtSelectAllAboutUs->execute();
$result = $stmtSelectAllAboutUs->get_result();
$row = $result->fetch_assoc();

$postAboutUs = $row['posts'];

$sqlSelectAboutUsContent1 = "SELECT posts.*, topic.* FROM posts INNER JOIN topic
                            ON posts.topicID = topic.topicID
                            WHERE topic.topicID=?";
$stmtSelectAboutUsContent = $conn->prepare($sqlSelectAboutUsContent1);
$stmtSelectAboutUsContent->bind_param("s", $postAboutUsContentTopic1);
$stmtSelectAboutUsContent->execute();
$resultContent = $stmtSelectAboutUsContent->get_result();
$rowContent = $resultContent->fetch_assoc();

  $displaypostAboutUsContentTopic1 = $rowContent['topic'];
  $postAboutUsContent1 = $rowContent['posts'];


$sqlSelectAboutUsContent2 = "SELECT posts.*, topic.* FROM posts INNER JOIN topic
                            ON posts.topicID = topic.topicID
                            WHERE topic.topicID=?";
$stmtSelectAboutUsContent2 = $conn->prepare($sqlSelectAboutUsContent2);
$stmtSelectAboutUsContent2->bind_param("s",  $postAboutUsContentTopic2);
$stmtSelectAboutUsContent2->execute();
$resultContent2 = $stmtSelectAboutUsContent2->get_result();
$rowContent2 = $resultContent2->fetch_assoc();

$displaypostAboutUsContentTopic2 = $rowContent2['topic'];
$postAboutUsContent2 = $rowContent2['posts'];

$sqlSelectAboutUsContent3 = "SELECT posts.*, topic.* FROM posts INNER JOIN topic
                            ON posts.topicID = topic.topicID
                            WHERE topic.topicID=?";
$stmtSelectAboutUsContent3 = $conn->prepare($sqlSelectAboutUsContent3);
$stmtSelectAboutUsContent3->bind_param("s",  $postAboutUsContentTopic3);
$stmtSelectAboutUsContent3->execute();
$resultContent3 = $stmtSelectAboutUsContent3->get_result();
$rowContent3 = $resultContent3->fetch_assoc();

$displaypostAboutUsContentTopic3  = $rowContent3['topic'];
$postAboutUsContent3 = $rowContent3['posts'];




?>
