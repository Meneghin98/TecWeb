<?php
require_once("helps/connessione.php");
require_once("helps/replace.php");
require_once("helps/checks.php");

session_start();

$file = str_replace('£footer', html::footer(),
    str_replace('£header', html::header(),
        str_replace('£head_', html::head(),
            file_get_contents("../html/User/areaUtente.html"))));
$DB = new DBConnection();
$utente = $DB->getUtenteArray($_SESSION['nickname']);
$file = str_replace('£immgaine_utente£', $utente['img'], $file);

if (!isset($_POST['salva'])) { //l'utente arriva sulla pagina da un link esterno
    $file = str_replace('£messaggio', '', $file);//rimuovo il segnaposto
    //riempio i campi con i suoi dati
    $form = "<fieldset class=\"groupBox\">
                <legend>Utente</legend>
                <label for=\"nickname\" xml:lang=\"en\">Nickname</label>
                <input name=\"nickname\" type=\"text\" id=\"nickname\" value=\"$utente[nickname]\"/>
                <label for=\"name\">Nome:</label>
                <input name=\"nome\" type=\"text\" id=\"name\" value=\"$utente[nome]\"/>
                <label for=\"surname\">Cognome:</label>
                <input name=\"cognome\" type=\"text\" id=\"surname\" value=\"$utente[cognome]\"/>
                <label for=\"email\" xml:lang=\"en\">E-mail:</label>
                <input name=\"email\" type=\"text\" id=\"email\" value=\"$utente[email]\"/>
            </fieldset>
            <fieldset class=\"groupBox\">
                <legend>Generale</legend>
                <p>Riferimento ad una pagina esterna come facebook, twitter, instagram</p>
                <label for=\"ref\">Riferimento:</label>
                <input name=\"riferimento\" type=\"text\" id=\"ref\" value=\"$utente[riferimento]\"/>
            </fieldset>";
} else { //l'utente ha premuto salva
    //controllo se ci sono errori negli input
    $errori = "";
    if ($_POST['nickname']!=$utente['nickname'] && $DB->existsNickname($_POST['nickname']))
        $errori .= "<li>Il nickname inserito è già in uso</li>";
    if (!checkNickname($_POST['nickname']))
        $errori .= "<li>Il nickname inserito contiene caratteri non consentiti</li>";
    if (!checkNome($_POST['nome']))
        $errori .= "<li>Verifica che il nome inserito sia corretto</li>";
    if (!checkCognome($_POST['cognome']))
        $errori .= "<li>Verifica che il cognome inserito sia corretto</li>";
    if (!checkEmail($_POST['email']))
        $errori .= "<li>Verifica che l'e-mail inserita sia valida</li>";
    if (!checkRiferimento($_POST['riferimento']))
        $errori .= "<li>Il riferimento inserito non è valido</li>";

    if ($_POST['oldPwd'] != "") { //se è stata inserita la password vuol dire che voglio modificarla
        if ($_POST['oldPwd'] === $utente['password'])
            $errori .= "<li>La password inserita non è corretta</li>";
        if (!checkPassword($_POST['newPwd']))
            $errori .= "<li>La password inserita contiene caratteri non consentiti</li>";
        if ($_POST['newPwd'] === $_POST['repPwd'])
            $errori .= "<li>Le passwrod inserite non combaciano</li>";
    }

    if (!$errori) { //non c'è nessun errore, procedo a salvare i nuovi dati
        $DB->updateUser($_SESSION['nickname'], $_POST);
        $file = str_replace('£messaggio', '<p id="buonFine">I dati sono stati aggiornati correttamente</p>', $file);
    }
    else{ // ho trovato degli errori
        $file = str_replace('£messaggio', "<ul id='errori'>$errori</ul>", $file);
    }
    //riempio i campi della form con i valori inseriti dall'utente, anche se c'erano degli errori
    $form = "<fieldset class=\"groupBox\">
                <legend>Utente</legend>
                <label for=\"nickname\" xml:lang=\"en\">Nickname:</label>
                <input name=\"nickname\" type=\"text\" id=\"nickname\" value=\"$_POST[nickname]\"/>
                <label for=\"name\">Nome:</label>
                <input name=\"nome\" type=\"text\" id=\"name\" value=\"$_POST[nome]\"/>
                <label for=\"surname\">Cognome:</label>
                <input name=\"cognome\" type=\"text\" id=\"surname\" value=\"$_POST[cognome]\"/>
                <label for=\"email\" xml:lang=\"en\">E-mail:</label>
                <input name=\"email\" type=\"text\" id=\"email\" value=\"$_POST[email]\"/>
            </fieldset>
            <fieldset class=\"groupBox\">
                <legend>Generale</legend>
                <p>Riferimento ad una pagina esterna come facebook, twitter, instagram</p>
                <label for=\"ref\">Riferimento:</label>
                <input name=\"riferimento\" type=\"text\" id=\"ref\" value=\"$_POST[riferimento]\"/>
            </fieldset>";
}
$file = str_replace('£form', $form, $file);

$DB->close();
echo $file;


