<?php

class html
{

    public static function head()
    {
        return file_get_contents("../html/head.html");
    }

    public static function header($isOn = null)
    {
        $rep = file_get_contents("../html/header.html");
        if (isset($_SESSION['loggato']) && $_SESSION['loggato'] == true) { //verifico che un'utente è loggato oppure no
            if ($isOn=== 'utente') {
                $change="<img id=\"logged\" src=\"../images/icons/login-sito-web.png\" alt=\"Area utente\"/>";
            }else{
                $change = "<a id=\"login\" title=\"Area utente\" href=\"../php/personal.php\"><img
                src=\"../images/icons/login-sito-web.png\" alt=\"Area utente\" /></a>";
            }
            $rep = str_replace("£utente", $change, $rep);
        } else {
            if ($isOn==='login'){
                $change = "<img id=\"logged\" src=\"../images/icons/loginMobile.png\" alt=\"login e registrazione\" />";
            }else {
                $change = "<a id=\"login\" title=\"Login e registrazione\" href=\"../php/login.php\"><img
                src=\"../images/icons/loginMobile.png\" alt=\"login e registrazione\" /></a>";
            }
            $rep = str_replace("£utente", $change, $rep);
        }
        return $rep;
    }

    public static function rightPanel()
    {
        return file_get_contents("../html/rightPanel.html");
    }

    public static function checkLoggedUser($obj = null) {
        if($_SESSION['loggato'] == true) {
            // Pagine generiche
            $obj = str_replace('<a href="registrazione.php" tabindex="0">Crea un account</a>', 'Crea un account', $obj);
            $obj = str_replace('<a href="login.php" tabindex="0">Accedi</a>', 'Accedi', $obj);

            // Index
            $obj = str_replace('<a href="php/registrazione.php" tabindex="0">Crea un account</a>', 'Crea un account', $obj);
            $obj = str_replace('<a href="php/login.php" xml:lang="en" tabindex="0">Accedi</a>', 'Accedi', $obj);
        }
        return $obj;
    }

    public static function linked_obj($type_linked_obj, $type_obj, $type_page = 'not_a_page')
    {
        if ($type_linked_obj == "menu")
            $obj = file_get_contents("../html/menu.html");
        else if ($type_linked_obj == "footer")
            $obj = file_get_contents("../html/footer.html");
        else
            return 0;

        if ($type_obj == 'News' || $type_obj == 'Recensioni' || $type_obj == 'Altro') {
            $obj = str_replace('£link1', '<li><a href="../index.php" tabindex="0"><span xml:lang="en">Home</span></a></li>', $obj);
            $obj = str_replace('£link2', '<li><a href="page.php?t=n" tabindex="0"><span xml:lang="en">Notizie</span></a></li>', $obj);
            $obj = str_replace('£link3', '<li><a href="page.php?t=r" tabindex="0">Recensioni</a></li>', $obj);
            $obj = str_replace('£link4', '<li><a href="page.php?t=a" tabindex="0">Altro</a></li>', $obj);
            $obj = str_replace('£link7', '<li><a href="chiSiamo.php" tabindex="0">Chi siamo</a></li>', $obj);


            switch($type_obj)
            {
                case 'News':
                    $obj = str_replace('<li><a href="page.php?t=n" tabindex="0"><span xml:lang="en">Notizie</span></a></li>', '<li class="currentlink"><a href="page.php?t=n" tabindex="0"><span xml:lang="en">Notizie</span></a></li>', $obj);
                    break;
                case 'Recensioni':
                    $obj = str_replace('<li><a href="page.php?t=r" tabindex="0">Recensioni</a></li>', '<li class="currentlink"><a href="page.php?t=r" tabindex="0">Recensioni</a></li>', $obj);
                    break;
                case 'Altro':
                    $obj = str_replace('<li><a href="page.php?t=a" tabindex="0">Altro</a></li>', '<li class="currentlink"><a href="page.php?t=a" tabindex="0">Altro</a></li>', $obj);
            }
        }

        if ($type_obj == 'page') {
            $obj = str_replace('£link1', '<li><a href="../index.php" tabindex="0"><span xml:lang="en">Home</span></a></li>', $obj);
            $obj = str_replace('£link2', '<li><a href="page.php?t=n" tabindex="0"><span xml:lang="en">Notizie</span></a></li>', $obj);
            $obj = str_replace('£link3', '<li><a href="page.php?t=r" tabindex="0">Recensioni</a></li>', $obj);
            $obj = str_replace('£link4', '<li><a href="page.php?t=a" tabindex="0">Altro</a></li>', $obj);
            $obj = str_replace('£link7', '<li><a href="chiSiamo.php" tabindex="0">Chi siamo</a></li>', $obj);


            switch ($type_page) {
                case 'n':
                    $obj = str_replace('<li><a href="page.php?t=n" tabindex="0"><span xml:lang="en">Notizie</span></a>', '<li class="currentlink"><span xml:lang="en">Notizie</span>', $obj);
                    break;
                case 'r':
                    $obj = str_replace('<li><a href="page.php?t=r" tabindex="0">Recensioni</a>', '<li class="currentlink">Recensioni', $obj);
                    break;
                case 'a':
                    $obj = str_replace('<li><a href="page.php?t=a" tabindex="0">Altro</a>', '<li class="currentlink">Altro', $obj);
                    break;
            }
        }

        if ($type_linked_obj == 'footer') {
            $obj = str_replace('£link5', '<li><a href="login.php" tabindex="0">Accedi</a></li>', $obj);
            $obj = str_replace('£link6', '<li><a href="registrazione.php" tabindex="0">Crea un account</a></li>', $obj);
            $obj = str_replace('£link7', '<li><a href="chiSiamo.php" tabindex="0">Chi siamo</a></li>', $obj);

            switch ($type_page) {
                case 'accedi':
                    $obj = str_replace('<a href="login.php" tabindex="0">Accedi</a>', 'Accedi', $obj);
                    break;
                case 'registrazione':
                    $obj = str_replace('<a href="registrazione.php" tabindex="0">Crea un account</a>', 'Crea un account', $obj);
                    break;
                case 'chi_siamo':
                    $obj = str_replace('<a href="chiSiamo.php" tabindex="0">Chi siamo</a>', 'Chi siamo', $obj);
                    break;
            }
        }

        // Controllo utente autenticato
        $obj = html::checkLoggedUser($obj);

        return $obj;
    }

    public static function rightPanelBuilder($file) {
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

        return $file;
    }

    public static function pageBuilder($file, $page_type = null ) {
        $file = str_replace('£head_', html::head(), $file);
        $file = str_replace('£footer', html::linked_obj('footer', 'page', $page_type), $file);
        $file = str_replace('£header', html::header(), $file);
        $file = str_replace('£rightPanel', html::rightPanel(), $file);
        $file = html::rightPanelBuilder($file);
        $file = str_replace('£menu_', html::linked_obj('menu', 'page', $page_type), $file);

        return $file;
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
        if (!$isLogged) { //sostituisce l'input del "mi piace" con un link al login (un utente non loggato non pùò inserire "mi piace")
            foreach ($commenti_array as $commento) {
                $commenti .= "<li id=\"commento_$commento[id]\" class=\"commento\"><h3><a href=\"utente.php?nick=$commento[utente]\">$commento[utente]</a></h3><p>$commento[data]</p><pre>$commento[testo]</pre><a href=\"login.php\" class=\"miPiace upGray \" id=\"Label$commento[id]\" onmouseover=\"miPiaceOver('Label$commento[id]')\" onmouseout=\"miPiaceOut('Label$commento[id]')\">Mi piace</a><p class=\"numeroLike\">$commento[likes]</p></li>";
            }
        } else {
            foreach ($commenti_array as $commento) {
                $commenti .= "<li id=\"commento_$commento[id]\" class=\"commento\"><h3><a href=\"utente.php?nick=$commento[utente]\">$commento[utente]</a></h3><p>$commento[data]</p><pre>$commento[testo]</pre>";
                if ($_SESSION['level'] == 'admin' || $_SESSION['nickname'] == $commento['utente']) //l'utente è un admin oppure è un suo commento, aggiungo la possibilità di rimuovere il commento
                    $commenti.= "<label onclick=\"eliminaCommento('commento_$commento[id]')\" class=\"delete\" title=\"Rimuovi commento\" for=\"delete_$commento[id]\">Elimina commento</label><input id=\"delete_$commento[id]\" type=\"button\" value=\"delete\" name=\"elimina commento\" />";
                $commenti .= "<label title=\"Mi piace\" class=\"miPiace ";
                if (self::array_contain($commento['id'], $id_commenti_con_like)) //controllo se il commento ha il mipiace dell'utente loggato
                    $commenti .= " upBlue";
                else
                    $commenti .= " upGray";
                $commenti .= " \" for=\"input_$commento[id]\" id=\"Label$commento[id]\" onclick=\"miPiace('Label$commento[id]')\" onmouseover=\"miPiaceOver('Label$commento[id]')\" onmouseout=\"miPiaceOut('Label$commento[id]')\">Mi piace</label><input  id=\"input_$commento[id]\" type=\"button\" value=\"up\" name=\"miPiace\" /><p class=\"numeroLike\">$commento[likes]</p></li>";
            }
        }
        return $commenti;
    }

    public static function top3($top3_array)
    {
        $top3articoli = "";
        for ($i = 0; $i < sizeof($top3_array); $i++) {
            $top3 = $top3_array[$i];
            $top3articoli .= "<dd><a href=\"$top3[pathID]\"><img src=\"../$top3[img]\" alt=\"$top3[alt]\"/><span>$top3[titolo]</span></a></dd>";
        }
        return $top3articoli;
    }
    public static function lastRew($lastRew_array)
    {
        $lastRewarticolo = "";
        for ($i = 0; $i < sizeof($lastRew_array); $i++) {
            $lastRew = $lastRew_array[$i];
            $lastRewarticolo .= "<dd><a href=\"$lastRew[pathID]\"><img src=\"../$lastRew[img]\" alt=\"$lastRew[alt]\"/><span>$lastRew[titolo]</span></a></dd>";
        }
        return $lastRewarticolo;
    }

}