<?php
require_once("connessione.php");
require_once("replace.php");
require_once("checks.php");

session_start();

$file = file_get_contents("../html/User/registrazione.html");
$file = str_replace('£head_', html::head(), $file);
$file = str_replace('£footer', html::linked_obj("footer","page", "registrazione"), $file);
$file = str_replace('£menu_', html::linked_obj("menu","page", "registrazione"), $file);
$file = str_replace('£header', html::header(), $file);

function checkInput($nome, $cognome, $nickname, $email, $password) {



    $messaggio = "";

    if(!checkNome($nome)) {
        $messaggio .= "<li>Il nome che &egrave; stato inserito non &egrave; conforme</li>";
    }
    if(!checkCognome($cognome)) {
        $messaggio .= "<li>Il cognome che &egrave; stato inserito non &egrave; conforme</li>";
    }
    if(!checkNickname($nickname)) {
    $messaggio .= "<li>Il nickname che &egrave; stato inserito non &egrave; conforme</li>";
    }
    if(!checkEmail($email)) {
        $messaggio .= "<li>L'email che &egrave; stata inserita non &egrave; conforme</li>";
    }
    if(!checkPassword($password)) {
        $messaggio .= "<li>La password che &egrave; stata inserita non &egrave; conforme</li>";
    }
    return $messaggio;
}


if(isset($_POST['conferma'])){ //dopo premuto pulsante conferma

    $nome = trim($_POST["nome"]);
    $cognome = $_POST["cognome"];
    $nickname = $_POST["nickname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $db = new DBConnection();
    $Messaggio = checkInput($nome,$cognome,$nickname,$email,$password);
    if($db->existsNickname($nickname)){
        $Messaggio .= "<li>Il nickname inserito &egrave; gi&agrave; presente</li>";
    }
    $db->close();
    if(!$Messaggio) { //devo inserire i valori inseriti (che non presentano errori) nel database

        $db = new DBConnection();

        $db->newUser($nome,$cognome,$nickname,$email,$password);


        $_SESSION['loggato']=true;
        $_SESSION["nickname"]=$nickname;
        $_SESSION['level'] = $db->getUtenteArray($nickname)['tipologia'];
        $db->close();
        header("Location: ../index.php");
    }

    else { // ho premuto su conferma ma ho inserito dati sbagliati: visualizzo gli errori

        $Form = "<fieldset id=\"primoReg\">
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
                    <label for=\"nicknameReg\"><span xml:lang=\"en\"><span xml:lang=\"en\">Nickname</span>:</span></label>
                    <input id=\"nicknameReg\" name=\"nickname\" type=\"text\" value='$nickname'/>
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

        $BeginList = "<ul id='ViewErrorReg'>$Messaggio</ul>";


        $file = str_replace('£ErroriRegistrazine', $BeginList, $file);

    }
}


else { //&egrave; la prima volta che entro in registrazione
    $Form = "<fieldset id=\"primoReg\">
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
                    <label for=\"nicknameReg\"><span xml:lang=\"en\"><span xml:lang=\"en\">Nickname</span>:</span></label>
                    <input id=\"nicknameReg\" name=\"nickname\" type=\"text\" value=''/>
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


