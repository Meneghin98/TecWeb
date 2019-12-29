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

    public static function menu($type_of_menu, $type_page = 'n')
    {
        $menu = file_get_contents("../html/menu.html");

        if($type_of_menu == 'article') {
            $menu = str_replace('£link1', '<li><a href="../../index.php"><span xml:lang="en">Home</span></a></li>', $menu);
            $menu = str_replace('£link2', '<li><a href="../../php/page.php?t=n"><span xml:lang="en">News</span></a></li>', $menu);
            $menu = str_replace('£link3', '<li><a href="../../php/page.php?t=r">Recensioni</a></li>', $menu);
            $menu = str_replace('£link4', '<li><a href="../../php/page.php?t=a">Altro</a></li>', $menu);
        }

        /*
        if($type_of_menu == 'home') {
            $menu = str_replace('£link1', '<li><span xml:lang="en">Home</span></li>', $menu);
            $menu = str_replace('£link2', '<li><a href="php/page.php?t=n"><span xml:lang="en">News</span></a></li>', $menu);
            $menu = str_replace('£link3', '<li><a href="php/page.php?t=r">Recensioni</a></li>', $menu);
            $menu = str_replace('£link4', '<li><a href="php/page.php?t=a">Altro</a></li>', $menu);
        }*/

        if($type_of_menu == 'page') {
            $menu = str_replace('£link1', '<li><a href="../../index.php"><span xml:lang="en">Home</span></a></li>', $menu);
            $menu = str_replace('£link2', '<li><a href="page.php?t=n"><span xml:lang="en">News</span></a></li>', $menu);
            $menu = str_replace('£link3', '<li><a href="page.php?t=r">Recensioni</a></li>', $menu);
            $menu = str_replace('£link4', '<li><a href="page.php?t=a">Altro</a></li>', $menu);

            switch ($type_page) {
                case 'n':
                    $menu = str_replace('<li><a href="../../php/page.php?t=n"><span xml:lang="en">News</span></a>', '<li id="currentlink"><span xml:lang="en">News</span>', $menu);
                    break;
                case 'r':
                    $menu = str_replace('<li><a href="../../php/page.php?t=r">Recensioni</a>', '<li id="currentlink">Recensioni', $menu);
                    break;
                case 'a':
                    $menu = str_replace('<l><a href="../../php/page.php?t=a">Altro</a>', '<li id="currentlink">Altro', $menu);
                    break;
            }
        }
        return $menu;
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
            }
        }
        return false;
    }

    public static function commenti($commenti_array, $id_commenti_con_like, $isLogged)
    {
        $commenti = "";
        if (!$isLogged){ //sostituisce l'input del "mi piace" con un link al login (un utente non loggato non pùò inserire "mi piace")
            foreach ($commenti_array as $commento) {
                $commenti .= "<li class=\"commento\"><h3><a href=\"utente.php?nick=$commento[utente]\">$commento[utente]</a></h3><p>$commento[data]</p><pre>$commento[testo]</pre><a href=\"login.php\" class=\"miPiace upGray \" id=\"$commento[id]Label\" onmouseover=\"miPiaceOver('$commento[id]Label')\" onmouseout=\"miPiaceOut('$commento[id]Label')\">Mi piace</a><p class=\"numeroLike\">$commento[likes]</p></li>";
            }
        }
        else if (is_null($id_commenti_con_like)){
            foreach ($commenti_array as $commento) {
                $commenti .= "<li class=\"commento\"><h3><a href=\"utente.php?nick=$commento[utente]\">$commento[utente]</a></h3><p>$commento[data]</p><pre>$commento[testo]</pre><label class=\"miPiace upGray \" for=\"$commento[id]\" id=\"$commento[id]Label\" onclick=\"miPiace('$commento[id]Label')\" onmouseover=\"miPiaceOver('$commento[id]Label')\" onmouseout=\"miPiaceOut('$commento[id]Label')\">Mi piace</label><input class=\"bottoneMiPiace\" id=\"$commento[id]\" type=\"button\" value=\"up\" name=\"miPiace\" /><p class=\"numeroLike\">$commento[likes]</p></li>";
            }
        }
        else {
            foreach ($commenti_array as $commento) {
                $commenti .= "<li class=\"commento\"><h3><a href=\"utente.php?nick=$commento[utente]\">$commento[utente]</a></h3><p>$commento[data]</p><pre>$commento[testo]</pre><label class=\"miPiace";
                if (self::array_contain($commento['id'], $id_commenti_con_like))
                    $commenti .= " upBlue";
                else
                    $commenti .= " upGray";
                $commenti .= " \" for=\"$commento[id]\" id=\"$commento[id]Label\" onclick=\"miPiace('$commento[id]Label')\" onmouseover=\"miPiaceOver('$commento[id]Label')\" onmouseout=\"miPiaceOut('$commento[id]Label')\">Mi piace</label><input class=\"bottoneMiPiace\" id=\"$commento[id]\" type=\"button\" value=\"up\" name=\"miPiace\" /><p class=\"numeroLike\">$commento[likes]</p></li>";
            }
        }
        return $commenti;
    }

}