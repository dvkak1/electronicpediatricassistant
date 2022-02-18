<?php

include "../config/db.php";
include "controllers/functionsFolder/functions.php";

$homePagePost = "";

$selectHomePageContents = viewHomePageContent(['topic' => "Home Page"]);

foreach($selectHomePageContents AS $selectHomePageContent) {
$homePagePost = $selectHomePageContent['posts'];
}


?>
