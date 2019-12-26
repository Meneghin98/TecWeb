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

    $likes = null;
    if (isset($_SESSION['loggato']) && $_SESSION['loggato'] == true) //utente loggato
    {
        $scriviCommento = "<form action=\"commento.php?id=$idArticolo\" id=\"ScriviCommento\" method=\"post\" onsubmit=\"return commentoVuoto()\"><fieldset><label for=\"textarea\">Scrivi il tuo commento:</label><textarea name=\"commentoUtente\" id=\"textarea\" rows=\"6\" cols=\"0\" onkeyup=\"updateNum()\"></textarea><p id=\"MaxChar\">300</p><label for=\"Invia\" id=\"commenta\" >Commenta</label><input type=\"submit\" name=\"InviaCommento\" id=\"Invia\" /></fieldset></form>";
        $likes = $DB->getLikesOfUser($_SESSION['nickname'], $idArticolo);
    } else //utente non loggato
    {
        $scriviCommento = "<p><a href=\"login.php\">Accedi</a> o <a href=\"registrazione.php\">registrati</a> per poter commentare</p>";
    }
    $paginaArticolo = str_replace('£scriviCommento', $scriviCommento, $paginaArticolo);

    $commenti = $DB->getCommentsArrayOfArtile($idArticolo);
    if (is_null($commenti))
        $paginaArticolo = str_replace('£commenti', '<p>Non ci sono commenti al momento</p>', $paginaArticolo);
    else {
        $paginaArticolo = str_replace('£commenti', "<ul>£commenti</ul>", $paginaArticolo);
        $paginaArticolo = str_replace('£commenti', html::commenti($commenti, $likes, $_SESSION['loggato']), $paginaArticolo);
    }
    $DB->close();
}
echo $paginaArticolo;