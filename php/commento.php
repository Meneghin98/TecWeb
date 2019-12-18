<?php
require_once ("helps/connessione.php");

session_start();
$_SESSION['nick'] = "user"; //fake user
$txt = addslashes(trim($_POST['commentoUtente']));
$DB = new DBConnection();
$DB->putComment($txt, $_SESSION['nick'], $_GET['id']);
$DB->close();
header("Location: articolo.php?id=$_GET[id]#TitoloCommenti");
