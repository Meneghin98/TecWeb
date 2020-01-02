<?php

require_once("helps/connessione.php");
require_once("helps/replace.php");

$file = file_get_contents("../html/User/areaUtenteExt.html");
$file = str_replace('£header', html::header(), $file);
$file = str_replace('£head_',html::head(), $file);
$file = str_replace('£footer', html::footer(), $file);

$DB = new DBConnection();
$utente = $DB->getUtenteArray($_GET['nick']);

$file = str_replace('£immgaine_utente£', $utente['img'], $file);
$file = str_replace('£nick',$utente['nickname'],$file);
$file = str_replace('£nome',$utente['nome'],$file);
$file = str_replace('£cognome',$utente['cognome'],$file);
if (is_null($utente['riferimento']))
    $file = str_replace('£ref','',$file);
else
    $file = str_replace('£ref',"<li>Riferimento: $utente[riferimento]</li>",$file);
$DB->close();
echo $file;