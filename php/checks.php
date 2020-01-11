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
    if(!preg_match('/^([A-Za-z]{2,15})$/', $cognome))
        return false;
    return true;
}

function checkEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function checkPassword($password){
    if(strlen($password) < 3) {
       return false;
    }
    return true;
}

function checkRiferimento($riferimento){
    return true;//implementare
}