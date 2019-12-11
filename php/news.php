<?php
require_once("helps/replace.php");
require_once("helps/connessione.php");

$_news = file_get_contents("../html/News/news.html");
$_news = str_replace('£footer', html::footer(), $_news);
$_news = str_replace('£header', html::header(), $_news);

$DB = new DBConnection();
$articoliNews = $DB->getArticlesArray("News");
if (!is_null($articoliNews)){
    $_news = str_replace('£articoli', html::articoli($articoliNews, 0), $_news);
}
$DB->close();
echo str_replace('£head', html::head(), $_news);