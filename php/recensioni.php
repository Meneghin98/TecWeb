<?php
require_once("helps/replace.php");
require_once("helps/connessione.php");

$_recensioni = file_get_contents("../html/Recensioni/recensioni.html");
$_recensioni = str_replace('£footer', html::footer(), $_recensioni);
$_recensioni = str_replace('£header', html::header(), $_recensioni);

$DB = new DBConnection();
$articoliRecensioni = $DB->getArticlesArray("Recensioni");
if (!is_null($articoliRecensioni)){
    $_recensioni = str_replace('£articoli', html::articoli($articoliRecensioni, 0), $_recensioni);
}
else{
    $_recensioni = str_replace('£articoli', '', $_recensioni);
}
$DB->close();
echo str_replace('£head', html::head(), $_recensioni);