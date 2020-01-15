<?php
require_once("connessione.php");
require_once("replace.php");

session_start();

/* se non viene inserito questo if e l'utente accede come prima volta alla pagina di un articolo (invece che prima passare
dall'index) viene mostrato un errore(di php) a inizio pagina
utente entra per la prima volta, rimane false finchè non accede */

if (!isset($_SESSION['loggato']))
    $_SESSION['loggato'] = false;

$DB = new DBConnection();
$idArticolo = $_GET['id'];
$ArticoloDB = $DB->getArticleByID($idArticolo);
$DB->viewArticle($idArticolo);
if (is_null($ArticoloDB))
    /* redirect */
    ;
else {
    $paginaArticolo = file_get_contents("../" . $ArticoloDB['path']);
    $paginaArticolo = str_replace('£head_', html::head(), $paginaArticolo);
    $paginaArticolo = str_replace('£header', html::header(), $paginaArticolo);
    $paginaArticolo = str_replace('£rightPanel', html::rightPanel(), $paginaArticolo);
    $paginaArticolo = str_replace('£footer', html::linked_obj('footer', 'article'), $paginaArticolo);
    $paginaArticolo = str_replace('£menu_', html::linked_obj('menu', 'article'), $paginaArticolo);

    /* Path all'articolo corrente
    $_string = $_SERVER['REQUEST_URI'];
    $_string = $_SERVER['SCRIPT_FILENAME'].$_string;
    $paginaArticolo = str_replace('£current_URI_ ', '/php/articolo.php?'.$_SERVER['QUERY_STRING'], $paginaArticolo); */

    $likes = null;
    if ($_SESSION['loggato'] == true) // utente loggato
    {
        $scriviCommento = "
            <form action=\"commento.php?id=$idArticolo\" id=\"ScriviCommento\" method=\"post\" onsubmit=\"return commentoVuoto()\">
                <fieldset>
                    <label for=\"textarea\">Scrivi il tuo commento:</label>
                    <textarea name=\"commentoUtente\" id=\"textarea\" rows=\"6\" cols=\"0\" onkeyup=\"updateNum()\"></textarea>
                        <p id=\"MaxChar\">300</p>
                    <label for=\"Invia\" id=\"commenta\" >Commenta</label>
                        <input type=\"submit\" name=\"InviaCommento\" id=\"Invia\" />
                </fieldset>
            </form>";

        $likes = $DB->getLikesOfUser($_SESSION['nickname'], $idArticolo);
    } else // utente non loggato
    {
        $scriviCommento = "
            <p><a href=\"login.php\">Accedi</a> o <a href=\"registrazione.php\">registrati</a> per poter commentare</p>";
    }

    $paginaArticolo = str_replace('£scriviCommento', $scriviCommento, $paginaArticolo);

    $commenti = $DB->getCommentsArrayOfArtile($idArticolo);
    if (is_null($commenti))
        $paginaArticolo = str_replace('£commenti', '<p>Non ci sono commenti al momento</p>', $paginaArticolo);
    else {
        $paginaArticolo = str_replace('£commenti', "<ul>£commenti</ul>", $paginaArticolo);
        $paginaArticolo = str_replace('£commenti', html::commenti($commenti, $likes, $_SESSION['loggato']), $paginaArticolo);
    }
    $top3 = $DB->getTop3();
    if (!is_null($top3)) {
        $paginaArticolo = str_replace('£top3', html::top3($top3), $paginaArticolo);
    } else {
        $paginaArticolo = str_replace('£top3', '', $paginaArticolo);
    }
    $lastRew = $DB->getLastRew();
    if (!is_null($lastRew)) {
        $paginaArticolo = str_replace('£lastRew', html::lastRew($lastRew), $paginaArticolo);
    } else {
        $paginaArticolo = str_replace('£lastRew', '', $paginaArticolo);
    }
    $DB->close();
    echo $paginaArticolo;
}