<?php
require_once('php/helps/connessione.php');
require_once('php/helps/replace.php');

$index = file_get_contents("html/index.html");

$db = new DBConnection();
$queryArticoli = $db->getArticlesArray(null);

if (!is_null($queryArticoli)) {
    $top_articoli = "";
    for ($i = 0; $i < 4; $i++) {
        $articolo = $queryArticoli[$i];
        $top_articoli .= "<li><a href=\"$articolo[path]\"><img src=\"$articolo[img]\" alt=\"$articolo[alt]\"/><span class=\"topArticleTitle\">$articolo[titolo]</span></a></li>";
    }
    $articoli = html::articoli($queryArticoli, $i);
    $articoli = str_replace('../', '', $articoli);
    $index = str_replace("£Articoli", $articoli, $index);
}
$db->close();
echo str_replace('£top_articles', $top_articoli, $index);