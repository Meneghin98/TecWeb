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
    public static function rightPanel()
    {
        return file_get_contents( "../html/rightPanel.html");
    }

    public static function linked_obj($type_linked_obj, $type_obj, $type_page = 'not_a_page')
    {
        /*
        if($type_obj == 'home') {

            if($type_linked_obj == 'menu')
                $obj = file_get_contents("html/menu.html");
            else
                $obj = file_get_contents("html/footer.html");

            $obj = str_replace('£link1', '<li id="currentlink"><span xml:lang="en">Home</span></li>', $obj);
            $obj = str_replace('£link2', '<li><a href="php/page.php?t=n"><span xml:lang="en">News</span></a></li>', $obj);
            $obj = str_replace('£link3', '<li><a href="php/page.php?t=r">Recensioni</a></li>', $obj);
            $obj = str_replace('£link4', '<li><a href="php/page.php?t=a">Altro</a></li>', $obj);

            return $obj;
        }*/

        if($type_linked_obj == "menu")
            $obj = file_get_contents("../html/menu.html");
        else if($type_linked_obj == "footer")
            $obj = file_get_contents("../html/footer.html");
        else
            return 0;

        if($type_obj == 'article') {
            $obj = str_replace('£link1', '<li><a href="../index.php" tabindex="0"><span xml:lang="en">Home</span></a></li>', $obj);
            $obj = str_replace('£link2', '<li><a href="page.php?t=n" tabindex="0"><span xml:lang="en">News</span></a></li>', $obj);
            $obj = str_replace('£link3', '<li><a href="page.php?t=r" tabindex="0">Recensioni</a></li>', $obj);
            $obj = str_replace('£link4', '<li><a href="page.php?t=a" tabindex="0">Altro</a></li>', $obj);
        }

        if($type_obj == 'page') {
            $obj = str_replace('£link1', '<li><a href="../index.php" tabindex="0"><span xml:lang="en">Home</span></a></li>', $obj);
            $obj = str_replace('£link2', '<li><a href="page.php?t=n" tabindex="0"><span xml:lang="en">News</span></a></li>', $obj);
            $obj = str_replace('£link3', '<li><a href="page.php?t=r" tabindex="0">Recensioni</a></li>', $obj);
            $obj = str_replace('£link4', '<li><a href="page.php?t=a" tabindex="0">Altro</a></li>', $obj);

            switch ($type_page) {
                case 'n':
                    $obj = str_replace('<li><a href="php/page.php?t=n"><span xml:lang="en">News</span></a>', '<li id="currentlink"><span xml:lang="en">News</span>', $obj);
                    break;
                case 'r':
                    $obj = str_replace('<li><a href="php/page.php?t=r">Recensioni</a>', '<li id="currentlink">Recensioni', $obj);
                    break;
                case 'a':
                    $obj = str_replace('<l><a href="php/page.php?t=a">Altro</a>', '<li id="currentlink">Altro', $obj);
                    break;
            }
        }

        if($type_linked_obj == 'footer') {
            $obj = str_replace('£link5', '<li><a href="php/login.php" tabindex="0">Accedi</a></li>', $obj);
            $obj = str_replace('£link6', '<li><a href="php/registrazione.php" tabindex="0">Crea un account</a></li>', $obj);
            $obj = str_replace('£link7', '<li><a href="" tabindex="0">Chi siamo</a></li>', $obj);
            $obj = str_replace('£link8', '<li><a href="" tabindex="0">Lavora con noi</a></li>', $obj);

            switch ($type_page) {
                case 'accedi':
                    $obj = str_replace('<a href="php/login.php" tabindex="0">Accedi</a>', 'Accedi', $obj);
                    break;
                case 'registrazione':
                    $obj = str_replace('<a href="php/registrazione.php" tabindex="0">Crea un account</a>', 'Crea un account', $obj);
                    break;
                case 'chi_siamo':
                    $obj = str_replace('<a href="" tabindex="0">Chi siamo</a>', 'Chi siamo', $obj);
                    break;
                case 'lavora':
                    $obj = str_replace('<a href="" tabindex="0">Lavora con noi</a>', 'Lavora con noi', $obj);
                    break;
            }
        }

        return $obj;
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