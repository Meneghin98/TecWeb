<?php

require_once("connessione.php");
require_once("replace.php");

session_start();

$DB = new DBConnection();

$file = file_get_contents("../html/notFound.html");

$file = str_replace('£head_', html::head(), $file);
$file = str_replace('£footer', html::linked_obj('footer', 'page', null), $file);
$file = str_replace('£header', html::header(), $file);
$file = str_replace('£rightPanel', html::rightPanel(), $file);
$file = str_replace('£menu_', html::linked_obj('menu', 'page', null), $file);

echo $file;