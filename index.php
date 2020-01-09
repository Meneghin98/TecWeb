<?php
 require_once('php/helps/connessione.php');
 require_once('php/helps/replace.php');

 session_start();

/* utente entra per la prima volta, rimane false finchè non accede */

 if (!isset($_SESSION['loggato']))
    $_SESSION['loggato']=false;

 $index = file_get_contents("html/index.html");
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
    $articoli = html::articoli($queryArticoli, $i);
    $articoli = str_replace('articolo.php', 'php/articolo.php', $articoli);
    $index = str_replace("£Articoli", $articoli, $index);
 }
$top3 = $DB->getTop3();
if (!is_null($top3)) {
    $index = str_replace('£top3', html::top3($top3), $index);
} else {
    $index = str_replace('£top3', '', $index);

}
$lastRew = $DB->getLastRew();
if (!is_null($lastRew)) {
    $index = str_replace('£lastRew', html::lastRew($lastRew), $index);
} else {
    $index = str_replace('£lastRew', '', $index);
}
 $DB->close();
 $index = str_replace('£head_', file_get_contents("html/head.html"), $index);
 $index = str_replace('£top_articles', $top_articoli, $index);


echo str_replace('../', '', $index);
