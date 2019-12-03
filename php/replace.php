<?php
class html{
    public static function addHeader($file_w_noHeader){
        $_html = file_get_contents(file_w_noHeader);
        $_header = file_get_contents("../html/header.html");

        $html_w_header = str_replace('<segnaposto/>', $_header, $_html);

    }

}
?>