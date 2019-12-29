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
    $errors = true;
    if(strlen($password) < 8) {
        $errors = "La password deve contenere almeno otto caratteri";
    }

    if(!preg_match('/^[A-Za-z]{8,16}$/', $password)) {
        $errors = "La password deve contenere almeno un numero";
    }

    if(!preg_match('/^[0-9]{8,16}$/', $password)) {
        $errors = "La password deve contenere almeno un carattere";
    }

    return $errors;
}

function checkRiferimento($riferimento){
    return true;//implementare
}