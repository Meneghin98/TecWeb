<?php
function checkNickname($nickname){
    return true; //implementare
}

function checkNome($nome){
    if (!preg_match ('/^([a-zA-Z]{3,15})$/', $nome))
        return false;
    return true;
}
function checkCognome($cognome){
    return true;//implementare
}
function checkEmail($email){
    return true;//implementare
}
function checkPassword($password){
    return true;//implementare
}
function checkRiferimento($riferimento){
    return true;//implementare
}