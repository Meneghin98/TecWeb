<?php
require_once("replace.php");

$_news = file_get_contents("../html/News/news.html");
$_news = str_replace('£header', html::header(), $_news);
echo str_replace('£menu', html::menu("news"), $_news);


?>