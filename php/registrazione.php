<?php
require_once("helps/connessione.php");
require_once("helps/replace.php");

session_start();

$file = html::registrazione();
$file = str_replace('£head_', html::head(), $file);
$file = str_replace('£footer', html::footer(), $file);
$file = str_replace('£header', html::header(), $file);

function checkInput($nome, $cognome, $username, $email, $password) {

    $messaggio = "";

    if(!preg_match ('/^([a-zA-Z]{3,15})$/', $nome)) {
        $messaggio .= "<li>Il nome che è stato inserito non è conforme</li>";
    }
    if(!preg_match ('/^([a-zA-Z]{3,15})$/', $cognome)) {
        $messaggio .= "<li>Il cognome che è stato inserito non è conforme</li>";
    }
    if(!preg_match('/^([a-zA-Z1-9]{3,15})$/', $username)) {
        $messaggio .= "<li>L'username che è stato inserito non è conforme</li>";
    }
    if(!preg_match ("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
        $messaggio .= "<li>L'email che è stata inserita non è conforme</li>";
    }
    if(!preg_match ("/^(?=.*[0-9])(?=.*[a-z])[a-zA-Z0-9!.@#$%^&*]{6,16}$/", $password)) {
        $messaggio .= "<li>La password che è stata inserita non è conforme</li>";
    }
    return $messaggio;
}


if(isset($_POST['conferma'])){ //dopo premuto pulsante conferma

    $nome = trim($_POST["nome"]);
    $cognome = $_POST["cognome"];
    $nickname = $_POST["nickname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $Messaggio = checkInput($nome,$cognome,$nickname,$email,$password);

    if(!$Messaggio) { //devo inserire i valori inseriti (che non presentano errori) nel database

        $db = new DBConnection();

        $db->newUser($nome,$cognome,$nickname,$email,$password);

        $db->close();

        $_SESSION['loggato']=true;
        $_SESSION["nickname"]=$nickname;
        header("Location: ../index.php");
    }

    else { // ho premuto su conferma ma ho inserito dati sbagliati: visualizzo gli errori

        $Form = "<fieldset>
                <legend>Info Personali</legend>
                <div class=\"ManageReg\">
                    <label for=\"nomeReg\">Nome:</label>
                    <input id=\"nomeReg\" name=\"nome\" type=\"text\" value='$nome'/>
                </div>
                <div class=\"ManageReg\">
                    <label for=\"cognomeReg\">Cognome:</label>
                    <input id=\"cognomeReg\" name=\"cognome\" type=\"text\" value='$cognome'/>
                </div>
            </fieldset>
            <fieldset id=\"secondReg\">
                <legend>Info Account</legend>
                <div class=\"ManageReg\">
                    <label for=\"usernameReg\"><span xml:lang=\"en\"><span xml:lang=\"en\">Username</span>:</span></label>
                    <input id=\"usernameReg\" name=\"nickname\" type=\"text\" value='$nickname'/>
                </div>
                <div class=\"ManageReg\">
                    <label for=\"emailReg\"><span xml:lang=\"en\">Email</span>:</label>
                    <input id=\"emailReg\" name=\"email\" type=\"text\" value='$email'/>
                </div>
                <div class=\"ManageReg\">
                    <label for=\"passwordReg\"><span xml:lang=\"en\">Password</span>:</label>
                    <input id=\"passwordReg\" type=\"password\" name=\"password\" value=''/>
                </div>
            </fieldset>";
        $file = str_replace( '£form', $Form, $file);

        $BeginList = "<div id='ViewErrorReg'><ul>$Messaggio</ul></div>";


        $file = str_replace('£ErroriRegistrazine', $BeginList, $file);

    }
}


else { //è la prima volta che entro in registrazione
    $Form = "<fieldset>
                <legend>Info Personali</legend>
                <div class=\"ManageReg\">
                    <label for=\"nomeReg\">Nome:</label>
                    <input id=\"nomeReg\" name=\"nome\" type=\"text\" value=''/>
                </div>
                <div class=\"ManageReg\">
                    <label for=\"cognomeReg\">Cognome:</label>
                    <input id=\"cognomeReg\" name=\"cognome\" type=\"text\" value=''/>
                </div>
            </fieldset>
            <fieldset id=\"secondReg\">
                <legend>Info Account</legend>
                <div class=\"ManageReg\">
                    <label for=\"usernameReg\"><span xml:lang=\"en\"><span xml:lang=\"en\">Username</span>:</span></label>
                    <input id=\"usernameReg\" name=\"nickname\" type=\"text\" value=''/>
                </div>
                <div class=\"ManageReg\">
                    <label for=\"emailReg\"><span xml:lang=\"en\">Email</span>:</label>
                    <input id=\"emailReg\" name=\"email\" type=\"text\" value=''/>
                </div>
                <div class=\"ManageReg\">
                    <label for=\"passwordReg\"><span xml:lang=\"en\">Password</span>:</label>
                    <input id=\"passwordReg\" type=\"password\" name=\"password\" value=''/>
                </div>
            </fieldset>";
    $file = str_replace( '£form', $Form, $file);
    $file = str_replace('£ErroriRegistrazine', "", $file);
}

echo $file;


