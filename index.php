<?php
 require_once('php/connessione.php');
 require_once('php/replace.php');
 require_once ('php/replace.php');

 session_start();

/* utente entra per la prima volta, rimane false finchè non accede */

 if (!isset($_SESSION['loggato']))
    $_SESSION['loggato']=false;

 $index = file_get_contents("html/index.html");
if (isset($_SESSION['loggato']) && $_SESSION['loggato'] == true) { //verifico che un'utente &egrave; loggato oppure no
    $change = "<a id=\"login\" title=\"Area utente\" href=\"../php/personal.php\"><img
                src=\"../images/icons/login-sito-web.png\" alt=\"Area utente\" /></a>";
    $index = str_replace("£utente", $change, $index);
} else {
    $change = "<a id=\"login\" title=\"Login e registrazione\" href=\"../php/login.php\"><img
                src=\"../images/icons/loginMobile.png\" alt=\"login e registrazione\" /></a>";
    $index = str_replace("£utente", $change, $index);
}
 $index = str_replace('£rightPanel', file_get_contents("html/rightPanel.html"), $index);

 $DB = new DBConnection();
 $queryArticoli = $DB->getArticlesArray(null);

 if (!is_null($queryArticoli)) {
    $top_articoli = "";
    for ($i = 0; $i < 4; $i++) {
        $articolo = $queryArticoli[$i];
        $top_articoli .=
            "<li><a href=\"php/$articolo[pathID]\"><img src=\"$articolo[img]\" alt=\"$articolo[alt]\"/>
                <span class=\"topArticleTitle\">$articolo[titolo]</span></a>
             </li>";
    }
    $articoli = html::articoli($queryArticoli, $i-1);
    $articoli = str_replace('articolo.php', 'php/articolo.php', $articoli);
    $index = str_replace("£Articoli", $articoli, $index);
 }
$top3 = $DB->getTop3();
if (!is_null($top3)) {
    $top3articolo=html::top3($top3);
    $top3articolo = str_replace('articolo.php', 'php/articolo.php', $top3articolo);

    $index = str_replace('£top3', $top3articolo, $index);
} else {
    $index = str_replace('£top3', '', $index);

}
$lastRew = $DB->getLastRew();
if (!is_null($lastRew)) {
    $lastRewarticolo=html::lastRew($lastRew);
    $lastRewarticolo = str_replace('articolo.php', 'php/articolo.php', $lastRewarticolo);

    $index = str_replace('£lastRew', $lastRewarticolo, $index);
} else {
    $index = str_replace('£lastRew', '', $index);
}
 $DB->close();
 $index = str_replace('£head_', file_get_contents("html/head.html"), $index);
 $index = str_replace('£top_articles', $top_articoli, $index);

 $index = html::checkLoggedUser($index);

echo str_replace('../', '', $index);
