<?php
require_once("helps/connessione.php");
require_once("helps/replace.php");

$DB = new DBConnection();
$ArticoloDB = $DB->getArticleByID($_GET['id']);
if(is_null($ArticoloDB))
    //redirect
    ;
else{
$articolo = file_get_contents("../" . $ArticoloDB['path']);
$DB->close();
}
echo $articolo;