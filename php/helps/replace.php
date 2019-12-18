<?php

class html
{
    public static function head(){
        return file_get_contents("../html/head.html");
    }
    public static function header()
    {
        //bisogna implementare il passaggio da utente registrato a non
        return file_get_contents("../html/header.html");
    }

    public static function footer()
    {
        //Rendere dinamica tramite risoluzione dei link circolari
        return file_get_contents("../html/footer.html");
    }

    public static function articoli($articoli_array, $first_index){
        $articoli = "";
        for($i = $first_index; $i<sizeof($articoli_array); $i++){
            $articolo = $articoli_array[$i];
            $articoli .= "<li><span class=\"categoriaGenerale $articolo[categoria]\">$articolo[titolo_categoria]</span><a href=\"$articolo[pathID]\"><img src=\"../$articolo[img]\" alt=\"$articolo[alt]\"/><span class=\"articleListTitle\">$articolo[titolo]</span></a><p class=\"articleListDesc\">$articolo[descrizione]</p></li>";
        }
        return $articoli;
    }
    public static function commenti($commenti_array){
        $commenti="";
        foreach($commenti_array as $commento){
            $commenti .= "<li class=\"commento\"><h3><a href=\"utente.php?nick=$commento[utente]\">$commento[utente]</a></h3><p>$commento[data]</p><pre>$commento[testo]</pre><label class=\"miPiace upGray\" for=\"$commento[id]\" id=\"$commento[id]Label\" onclick=\"miPiace('$commento[id]Label')\" onmouseover=\"miPiaceOver('$commento[id]Label')\" onmouseout=\"miPiaceOut('$commento[id]Label')\">Mi piace</label><input class=\"bottoneMiPiace\" id=\"$commento[id]\" type=\"button\" value=\"up\" name=\"miPiace\" /><p class=\"numeroLike\">$commento[likes]</p></li>";
        }
        return $commenti;
    }
}