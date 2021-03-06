<?php

session_start();

require_once("connessione.php");
require_once("replace.php");

$file = file_get_contents("../html/User/areaUtenteExt.html");
$file = str_replace('£header', html::header(), $file);
$file = str_replace('£head_',html::head(), $file);
$file = str_replace('£footer', html::linked_obj('footer', 'page'), $file);
$file = str_replace('£menu_', html::linked_obj('menu', 'page'), $file);

$DB = new DBConnection();
$utente = $DB->getUtenteArray($_GET['nick']);
if (is_null($utente))
    header('Location: notFound.php');
$file = str_replace('£immgaine_utente£', $utente['img'], $file);
$file = str_replace('£nick',$utente['nickname'],$file);
$file = str_replace('£nome',$utente['nome'],$file);
$file = str_replace('£cognome',$utente['cognome'],$file);
if (is_null($utente['riferimento']))
    $file = str_replace('£ref','',$file);
else {
    $link = $utente['riferimento'];
    if (!(strpos($utente['riferimento'], 'http') !== false)){
        $link = 'http:\\\\' . $link;
    }else{
        $utente['riferimento'] = str_replace('http:\\\\', '', $utente['riferimento']);
        $utente['riferimento'] = str_replace('https:\\\\', '', $utente['riferimento']); //solo uno dei due verrà eseguito
    }
    $file = str_replace('£ref', "<li>Riferimento: <a href=\"$link\">$utente[riferimento]</a></li>", $file);
}
$DB->close();
echo $file;