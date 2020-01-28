<?php
require_once("connessione.php");

$DB = new DBConnection();
$DB->removeComment($_GET['id']);
$DB->close();