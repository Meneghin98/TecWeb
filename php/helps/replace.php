<?php

class html
{

    public static function head()
    {
        return file_get_contents("../html/head.html");
    }

    public static function header()
    {
        $rep = file_get_contents("../html/header.html");
        if(isset($_SESSION['loggato']) && $_SESSION['loggato']==true) { //verifico che un'utente è loggato oppure no
            $change = "<a id=\"login\" title=\"Login e registrazione\" href=\"../php/personal.php\"><img
                src=\"../images/icons/login-sito-web.png\" alt=\"area utente\" /></a>";
            $rep = str_replace("£utente", $change, $rep);
        }
        else {
            $change = "<a id=\"login\" title=\"Login e registrazione\" href=\"../php/login.php\"><img
                src=\"../images/icons/Registrati-sito-web.png\" alt=\"login e registrazione\" /></a>";
            $rep = str_replace("£utente", $change, $rep);
        }
        return $rep;
    }

    public static function registrazione()
    {
        return file_get_contents( "../html/User/registrazione.html");
    }

    public static function footer()
    {
        //Rendere dinamica tramite risoluzione dei link circolari
        return file_get_contents("../html/footer.html");
    }

    public static function articoli($articoli_array, $first_index)
    {
        $articoli = "";
        for ($i = $first_index; $i < sizeof($articoli_array); $i++) {
            $articolo = $articoli_array[$i];
            $articoli .= "<li><span class=\"categoriaGenerale $articolo[categoria]\">$articolo[titolo_categoria]</span><a href=\"$articolo[pathID]\"><img src=\"../$articolo[img]\" alt=\"$articolo[alt]\"/><span class=\"articleListTitle\">$articolo[titolo]</span></a><p class=\"articleListDesc\">$articolo[descrizione]</p></li>";
        }
        return $articoli;
    }

    private static function array_contain($value, $array)
    {
        if (!is_null($array)) {
            foreach ($array as $item) {
                if ($item === $value) {
                    return true;
                }
                else
                    return false;
            }
        }
        return false;
    }

    public static function commenti($commenti_array, $id_commenti_con_like)
    {
        $commenti = "";
        $i = 0;
        foreach ($commenti_array as $commento) {
            $commenti .= "<li class=\"commento\"><h3><a href=\"utente.php?nick=$commento[utente]\">$commento[utente]</a></h3><p>$commento[data]</p><pre>$commento[testo]</pre><label class=\"miPiace";
            $commenti .= $commento['id'] == $id_commenti_con_like[$i] ? " upBlue" : " upGray";
            $commenti .= " \" for=\"$commento[id]\" id=\"$commento[id]Label\" onclick=\"miPiace('$commento[id]Label')\" onmouseover=\"miPiaceOver('$commento[id]Label')\" onmouseout=\"miPiaceOut('$commento[id]Label')\">Mi piace</label><input class=\"bottoneMiPiace\" id=\"$commento[id]\" type=\"button\" value=\"up\" name=\"miPiace\" /><p class=\"numeroLike\">$commento[likes]</p></li>";
            $i++;
        }
        return $commenti;
    }
}