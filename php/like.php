<?php
session_start();
require_once("helps/connessione.php");

$DB = new DBConnection();
if ($_GET['add'] == "true"){
    $DB->addLike($_SESSION['nickname'], $_GET['id']);
}
else{
    $DB->removeLike($_SESSION['nickname'], $_GET['id']);
}
$DB->close();