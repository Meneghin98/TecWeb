<?php
require_once("helps/connessione.php");
require_once("helps/replace.php");

$file = file_get_contents("../html/$path.html");
$file = str_replace('£footer', html::footer(), $file);
$file = str_replace('£header', html::header(), $file);

$nome = "";
$cognome = "";
$username = "";
$email = "";
$password = "";

function checkInput($nome, $cognome, $username, $email, $password) {
    $messaggio = "";

    if(!preg_match ('/^([a-zA-Z]{3,15})$/', $nome)) {
        $messaggio .= "[Verifica se il nome inserito sia corretto]";
    }
    if(!preg_match ('/^([a-zA-Z]{3,15})$/', $cognome)) {
        $messaggio .= "[Verifica se il cognome inserito sia corretto]";
    }
    if(!preg_match('/d{1,3}/',), $username) {
        $messaggio .= '[peso deve essere numerico]';
    }
    if(!preg_match ('/^([a-zA-Z]{3,15})$/', $email)) {
        $messaggio .= "[Verifica se il cognome inserito sia corretto]";
    }
    if(!preg_match ('/^([a-zA-Z]{3,15})$/', $password)) {
        $messaggio .= "[Verifica se il cognome inserito sia corretto]";
    }

    return $messaggio;
}

if(isset($_POST['submit']) && $_POST['submit'] == 'submit') {
    $messaggio = checkInput();
    if($messaggio) {

    }
    else {

    }

}


