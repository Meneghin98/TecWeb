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

$top3 = $DB->getTop3();
if (!is_null($top3)) {
    $file = str_replace('£top3', html::top3($top3), $file);
} else {
    $file = str_replace('£top3', '', $file);
}

$lastRew = $DB->getLastRew();
if (!is_null($lastRew)) {
    $file = str_replace('£lastRew', html::lastRew($lastRew), $file);
} else {
    $file = str_replace('£lastRew', '', $file);
}
$DB->close();
echo $file;