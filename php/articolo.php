<?php
require_once("helps/connessione.php");
require_once("helps/replace.php");

session_start();


$DB = new DBConnection();
$idArticolo = $_GET['id'];
$ArticoloDB = $DB->getArticleByID($idArticolo);
if (is_null($ArticoloDB))
    //redirect
    ;
else {
    $paginaArticolo = file_get_contents("../" . $ArticoloDB['path']);
    $paginaArticolo = str_replace('£head_', html::head(), $paginaArticolo);
    $paginaArticolo = str_replace('£header', html::header(), $paginaArticolo);
    $paginaArticolo = str_replace('£footer', html::footer(), $paginaArticolo);
    //$paginaArticolo = str_replace('£id', $idArticolo, $paginaArticolo);
    if ($_SESSION['loggato']) //utente loggato
    {
        $scriviCommento = "<form action=\"commento.php?id=$idArticolo\" id=\"ScriviCommento\" method=\"post\"><fieldset><label for=\"textarea\">Scrivi il tuo commento:</label><textarea name=\"commentoUtente\" id=\"textarea\" rows=\"6\" cols=\"0\" onkeyup=\"updateNum()\"></textarea><p id=\"MaxChar\">300</p><label for=\"Invia\" id=\"commenta\" >Commenta</label><input type=\"submit\" name=\"InviaCommento\" id=\"Invia\" /></fieldset></form>";
    } else //utente non loggato
    {
        $scriviCommento = "<p><a href=\"login.php\">Accedi</a> o <a href=\"registrazione.php\">registrati</a> per poter commentare</p>";
    }

    $paginaArticolo = str_replace('£scriviCommento', $scriviCommento, $paginaArticolo);

    $commenti = $DB->getCommentsArrayOfArtile($idArticolo);
    $likes = $DB->getLikesOfUser($_SESSION['nickname'], $idArticolo);
    if (is_null($commenti))
        $paginaArticolo = str_replace('£commenti', '<p>Non ci sono commenti al momento</p>', $paginaArticolo);
    else {
        $paginaArticolo = str_replace('£commenti', "<ul>£commenti</ul>", $paginaArticolo);
        $paginaArticolo = str_replace('£commenti', html::commenti($commenti, $likes), $paginaArticolo);
    }
    $DB->close();
}
echo $paginaArticolo;