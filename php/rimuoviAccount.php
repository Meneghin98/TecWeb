<?php
require_once("connessione.php");
session_start();


$DB = new DBConnection();
$DB->removeUser($_SESSION['nickname']);
$DB->close();

session_unset();
session_destroy();
header("Location: ../index.php");
