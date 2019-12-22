<?php
require_once("helps/connessione.php");
require_once("helps/replace.php");

session_start();
$_SESSION['nickname'] = "user"; //fake session

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
    $paginaArticolo = str_replace('£id', $idArticolo, $paginaArticolo);
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