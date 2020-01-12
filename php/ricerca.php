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

    if(strpos($articolo['titolo_categoria'], $pattern) !== false)
    {
        $indiceDiMatch = 1;
    }

    if(strpos($articolo['descrizione'], $pattern) !== false)
    {
        $indiceDiMatch = 2;
    }

    if(strpos($articolo['titolo'], $pattern) !== false)
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
$file = str_replace('£footer', html::linked_obj('footer', 'page', $_GET['t']), $file);
$file = str_replace('£header', html::header(), $file);
$file = str_replace('£rightPanel', html::rightPanel(), $file);
$file = str_replace('£menu_', html::linked_obj('menu', 'page', $_GET['t']), $file);

$file = str_replace('£articoli', html::articoli($listaArticoli_match, 0), $file);


// Mostra la pagina dei risultati

echo $file;
