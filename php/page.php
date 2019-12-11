<?php
require_once("helps/replace.php");
require_once("helps/connessione.php");

switch ($_GET['t']) {
    case 'n':
        $path = "News/news";
        $where = "News";
        break;
    case 'r':
        $path = "Recensioni/recensioni";
        $where = "Recensioni";
        break;
}

$file = file_get_contents("../html/$path.html");
$file = str_replace('£footer', html::footer(), $file);
$file = str_replace('£header', html::header(), $file);

$DB = new DBConnection();
$articoli = $DB->getArticlesArray($where);
if (!is_null($articoli)) {
    $file = str_replace('£articoli', html::articoli($articoli, 0), $file);
}
$DB->close();
echo str_replace('£head', html::head(), $file);