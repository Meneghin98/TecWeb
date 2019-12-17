<?php
require_once("helps/connessione.php");
require_once("helps/replace.php");

$DB = new DBConnection();
$articolo = file_get_contents("../" . $DB->getArticleByID($_GET['id'])['path']);
$DB->close();



echo $articolo;