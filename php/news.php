<?php

$_news = file_get_contents("../html/News/news.html");
$_header = file_get_contents("../html/header.html");
echo str_replace('£header', $_header, $_news);


?>