<?php
require_once("replace.php");

$_news = file_get_contents("../html/News/news.html");
echo str_replace('£header', html::header(), $_news);


?>