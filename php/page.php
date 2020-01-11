<?php
require_once("replace.php");
require_once("connessione.php");

switch ($_GET['t']) {
    case 'n':
        $path = "News/news";
        $where = "News";
        break;
    case 'r':
        $path = "Recensioni/recensioni";
        $where = "Recensioni";
        break;
    case 'a':
        $path = "Altro/altro";
        $where = "Altro";
        break;
}

$file = file_get_contents("../html/$path.html");
$file = str_replace('£footer', html::linked_obj('footer', 'page', $_GET['t']), $file);
$file = str_replace('£header', html::header(), $file);
$file = str_replace('£rightPanel', html::rightPanel(), $file);
$file = str_replace('£menu_', html::linked_obj('menu', 'page', $_GET['t']), $file);

$DB = new DBConnection();
$articoli = $DB->getArticlesArray($where);
if (!is_null($articoli)) {
    $file = str_replace('£articoli', html::articoli($articoli, 0), $file);
} else {
    $file = str_replace('£articoli', '', $file);
}

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
echo str_replace('£head_', html::head(), $file);
