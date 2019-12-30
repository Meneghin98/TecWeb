<?php

require_once("helps/connessione.php");
require_once("helps/replace.php");

$login = file_get_contents("../html/User/login.html");

$db = new DBConnection();

$email = $_POST["email"];
$password = $_POST["password"];

if(!isset($_SESSION))
    session_start();
if(isset($_SESSION['login']) && !$_SESSION['login']) {

    $MessaggioErrore = "<div id=ErrLog><p>Sono state inserite delle credenziali errate</p>";

    $login = str_replace('$ErroreLogin',$MessaggioErrore, $login);

    session_destroy();
}

echo $login;

?>