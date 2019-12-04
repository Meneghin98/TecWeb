<?php


function connect_db($host, $user, $pwd, $db){
    $connessione = new mysqli($host, $user, $pwd, $db);

    if (mysqli_connect_errno()) { 
        echo "Connessione fallita (". mysqli_connect_errno()  . "): " . mysqli_connect_error();
        exit();
    }
    return $connessione;
}

?>