<?php

require_once("connessione.php");
require_once("replace.php");

session_start();
$file = file_get_contents("../html/User/login.html");
$file = str_replace('£head_', html::head(), $file);
$file = str_replace('£footer', html::linked_obj("footer", "page", "accedi"), $file);
$file = str_replace('£menu_', html::linked_obj("menu", "page", "accedi"), $file);

$file = str_replace('£header', html::header('login'), $file);

if (isset($_POST['Accedi'])) {

    $db = new DBConnection();

    $nickname = trim($_POST["emailLogin"]);
    $password = trim($_POST["password"]);

    $errori = '';
    if (!$db->existsNickname($nickname))
        $errori .= '<li>Verifica che il nickname inserito sia valido</li>';

    if (!$db->exitsUser($nickname, $password))
        $errori .= '<li>La password inserita è errata</li>';

    if ($errori) {
        $form = " <div>  
                    <fieldset class=\"FormLogin\">
                    <legend>Accedi</legend> 
                        <div class=\"emailLog\">
                            <img src=\"../images/icons/email1.png\" alt=\"icona email\">
                            <label for=\"emailLogin\" xml:lang=\"en\"><span xml:lang=\"en\">Nickname:</span></label>
                            <input type=\"text\" name=\"emailLogin\" id=\"emailLogin\" value=\"$nickname\" />
                        </div>
                        <div class=\"passwordLog\">
                             <img src=\"../images/icons/lucchetto1.png\" alt=\"icona password\">
                             <label for=\"passwordLogin\" xml:lang=\"en\"><span xml:lang=\"en\">Password:</span></label>
                             <input type=\"password\" name=\"password\" id=\"passwordLogin\" value=\"\" />
                        </div> 
                    </fieldset>
                  </div>";
        $file = str_replace('£form', $form, $file);
        $beginList = '<div class="ErroriForm"><ul>' . $errori . '</ul></div>';
        $file = str_replace('£erroriLogin', $beginList, $file);
        echo $file;
    } else {
        $_SESSION['loggato'] = true;
        $_SESSION['nickname'] = $nickname;
        $_SESSION['level'] = $db->getUtenteArray($nickname)['tipologia'];
        $db->close();
        header("Location: ../index.php");
    }


} else { //è la prima volta che accedo
    $form = " <div>
                 <fieldset class=\"FormLogin\">
                  <legend>Accedi</legend>
    
                 <div class=\"emailLog\">
                        <img src=\"../images/icons/email1.png\" alt=\"icona email\">
                        <label for=\"emailLogin\" xml:lang=\"en\"><span xml:lang=\"en\">Nickname:</span></label>
                        <input type=\"text\" name=\"emailLogin\" id=\"emailLogin\" value=\"\"/>
                 </div>
                 <div class=\"passwordLog\">
                        <img src=\"../images/icons/lucchetto1.png\" alt=\"icona password\">
                        <label for=\"passwordLogin\" xml:lang=\"en\"><span xml:lang=\"en\">Password:</span></label>
                        <input type=\"password\" name=\"password\" id=\"passwordLogin\" value=\"\"/>
                 </div>
                 </fieldset>
             </div>";
    $file = str_replace('£form', $form, $file);
    $file = str_replace('£erroriLogin', "", $file);

    echo $file;

}

?>