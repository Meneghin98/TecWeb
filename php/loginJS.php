<?php
require_once ('connessione.php');

$nickname=$_GET['n'];
$password=$_GET['p'];

$db=new DBConnection();
$errori='0';
if (!$db->existsNickname($nickname))
    $errori = '1';
else if (!$db->exitsUser($nickname,$password))
    $errori = '2';

echo $errori;