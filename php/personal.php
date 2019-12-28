<?php
require_once("helps/connessione.php");
require_once("helps/replace.php");

$file = str_replace('£footer', html::footer(),
        str_replace('£header', html::header(),
        str_replace('£head_', html::head(),
        file_get_contents("../html/User/areaUtente.html"))));

$file = str_replace('£form', "<fieldset class=\"groupBox\">
                <legend>Utente</legend>
                <label for=\"nickname\"><span xml:lang=\"en\">Nickname</span></label>
                <input name=\"nickname\" type=\"text\" id=\"nickname\"/>
                <label for=\"name\">Nome:</label>
                <input name=\"name\" type=\"text\" id=\"name\"/>
                <label for=\"surname\">Cognome:</label>
                <input name=\"surname\" type=\"text\" id=\"surname\"/>
                <label for=\"email\"><span xml:lang=\"en\">E-mail</span>:</label>
                <input name=\"email\" type=\"text\" id=\"email\"/>
            </fieldset>

            <fieldset class=\"groupBox\">
                <legend>Sicurezza</legend>
                <label for=\"oldPwd\">Vecchia <span xml:lang=\"en\">password</span>:</label>
                <input name=\"oldPwd\" type=\"password\" id=\"oldPwd\"/>
                <label for=\"newPwd\">Nuova <span xml:lang=\"en\">password</span>:</label>
                <input name=\"newPwd\" type=\"password\" id=\"newPwd\"/>
                <label for=\"repPwd\">Ripeti <span xml:lang=\"en\">password</span>:</label>
                <input name=\"repPwd\" type=\"password\" id=\"repPwd\"/>
            </fieldset>

            <div class=\"groupBox\">
                <label for=\"ref\">Riferimento:</label>
                <input name=\"ref\" type=\"text\" id=\"ref\"/>
            </div>", $file);


if (isset($_POST['Salva']))
    $file = str_replace('£immgaine_utente£', "default.jpg", $file);



echo $file;