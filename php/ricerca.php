<?php

require_once("connessione.php");
require_once("replace.php");

session_start();

$DB = new DBConnection();


// Input

$listaArticoli = $DB->getArticlesArray(null);

$pattern = trim($_POST["searchInput"]);


// Output

$listaArticoli_match = [];


// Funzione di ricerca

foreach($listaArticoli as $articolo)
{
    $indiceDiMatch = 0;


    // Assegno indice di match

    if(stripos($articolo['titolo_categoria'], $pattern) !== false)
    {
        $indiceDiMatch = 1;
    }

    if(stripos($articolo['descrizione'], $pattern) !== false)
    {
        $indiceDiMatch = 2;
    }

    if(stripos($articolo['titolo'], $pattern) !== false)
    {
        $indiceDiMatch = 3;
    }


    // Aggiorno array dei match

    if($indiceDiMatch > 0)
    {
        array_push($listaArticoli_match, $articolo);
    }

}

// Costruisco la pagina dei risultati

$file = file_get_contents("../html/ricerca.html");

$file = str_replace('£head_', html::head(), $file);
$file = str_replace('£footer', html::linked_obj('footer', 'page', null), $file);
$file = str_replace('£header', html::header(), $file);
$file = str_replace('£rightPanel', html::rightPanel(), $file);
$file = str_replace('£menu_', html::linked_obj('menu', 'page', null), $file);

$file = str_replace('£articoli', html::articoli($listaArticoli_match, 0), $file);
$DB = new DBConnection();
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
// Mostra la pagina dei risultati

echo $file;
