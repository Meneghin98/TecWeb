<?php
require_once("helps/connessione.php");
require_once("helps/replace.php");

$DB = new DBConnection();
$ArticoloDB = $DB->getArticleByID($_GET['id']);
if(is_null($ArticoloDB))
    //redirect
    ;
else{
$paginaArticolo = file_get_contents("../" . $ArticoloDB['path']);
$paginaArticolo = str_replace('£head_', html::head(), $paginaArticolo);
$paginaArticolo = str_replace('£header', html::header(), $paginaArticolo);
$paginaArticolo = str_replace('£footer', html::footer(), $paginaArticolo);
$DB->close();
}
echo $paginaArticolo;