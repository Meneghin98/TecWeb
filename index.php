<?php
require_once('php/helps/connessione.php');
require_once('php/helps/replace.php');

session_start();
if (!isset($_SESSION['loggato']))//utente entra per la prima volta, rimane false finchè non accede
    $_SESSION['loggato']=false;

$index = file_get_contents("html/index.html");

$db = new DBConnection();
$queryArticoli = $db->getArticlesArray(null);

if (!is_null($queryArticoli)) {
    $top_articoli = "";
    for ($i = 0; $i < 4; $i++) {
        $articolo = $queryArticoli[$i];
        $top_articoli .= "<li><a href=\"php/$articolo[pathID]\"><img src=\"$articolo[img]\" alt=\"$articolo[alt]\"/><span class=\"topArticleTitle\">$articolo[titolo]</span></a></li>";
    }
    $articoli = html::articoli($queryArticoli, $i);
    $articoli = str_replace('articolo.php', 'php/articolo.php', $articoli);
    $index = str_replace("£Articoli", $articoli, $index);
}
$db->close();
echo str_replace('£top_articles', $top_articoli, $index);
