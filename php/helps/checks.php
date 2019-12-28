<?php

function checkNome($nome){
    if (!preg_match ('/^([a-zA-Z]{3,15})$/', $nome))
        return false;
    return true;
}
function checkCognome($cognome){
    return true;//implementare
}
function checkEmail($cognome){
    return true;//implementare
}
function checkPassword($cognome){
    return true;//implementare
}
function checkRiferimento($cognome){
    return true;//implementare
}