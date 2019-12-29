<?php
require_once ("helps/connessione.php");

session_start();
$txt = addslashes(trim($_POST['commentoUtente']));
$DB = new DBConnection();
if ($txt != "")
    $DB->putComment($txt, $_SESSION['nickname'], $_GET['id']);
$DB->close();
header("Location: articolo.php?id=$_GET[id]#TitoloCommenti");
