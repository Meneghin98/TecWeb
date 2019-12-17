<?php
require_once ("helps/connessione.php");

session_start();
$txt = $_POST['commentoUtente'];
$DB = new DBConnection();
$DB->putComment($txt, $_SESSION['nick']);

