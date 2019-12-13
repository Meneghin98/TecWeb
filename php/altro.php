<?php
require_once("helps/replace.php");
require_once("helps/connessione.php");

$_altro = file_get_contents("../html/Altro/altro.html");
$_altro = str_replace('£footer', html::footer(), $_altro);
$_altro = str_replace('£header', html::header(), $_altro);

$DB = new DBConnection();
$articoliRecensioni = $DB->getArticlesArray("Altro");
if (!is_null($articoliRecensioni)){
    $_altro = str_replace('£articoli', html::articoli($articoliRecensioni, 0), $_altro);
}
else{
    $_altro = str_replace('£articoli', '', $_altro);
}
$DB->close();
echo str_replace('£head', html::head(), $_altro);