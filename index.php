<?php
require_once('php\connessione.php');
require_once('php\replace.php');

$index = file_get_contents("html/index.html");

$db = new DBConnection();
$queryArticoli = $db->getArticlesArray();

$page = "";
if ($queryArticoli != null) {
    $top_articoli = "";
    for ($i = 0; $i < 4; $i++) {
        $articolo = $queryArticoli[$i];
        $top_articoli .= "<li><a href=\"$articolo[path]\"><img src=\"$articolo[img]\" alt=\"$articolo[alt]\"/><span class=\"topArticleTitle\">$articolo[titolo]</span></a></li>";
    }
    $articoli = "";
    while ($i < sizeof($queryArticoli)) {
        $articolo = $queryArticoli[$i];
        $articoli .= "<li><span class=\"$articolo[categoria]\">$articolo[titolo_categoria]</span><a href=\"$articolo[path]\"><img src=\"$articolo[img]\" alt=\"$articolo[alt]\"/><span class=\"articleListTitle\">$articolo[titolo]</span></a><p class=\"articleListDesc\">$articolo[descrizione]</p></li>";
        $i++;
    }
}
$db->close();
$index = str_replace('£top_articles', $top_articoli, $index);

echo str_replace("£Articoli", $articoli, $index);