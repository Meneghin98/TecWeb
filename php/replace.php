<?php
class html{
    public static function header() {
        //bisogna implementare il passaggio da utente registrato a non
        return file_get_contents("../html/header.html");
    }

    public static function footer(){
        return file_get_contents("../html/footer.html");
    }
}

?>