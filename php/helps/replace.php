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
            $articoli .= "<li><span class=\"categoriaGenerale $articolo[categoria]\">$articolo[titolo_categoria]</span><a href=\"$articolo[path]\"><img src=\"../$articolo[img]\" alt=\"$articolo[alt]\"/><span class=\"articleListTitle\">$articolo[titolo]</span></a><p class=\"articleListDesc\">$articolo[descrizione]</p></li>";
        }
        return $articoli;
    }
}