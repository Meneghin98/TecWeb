<?php

require_once("helps/connessione.php");
require_once("helps/replace.php");

session_start();
$file = file_get_contents("../html/User/login.html");
$file = str_replace('£head_', html::head(), $file);
$file = str_replace('£footer', html::footer(), $file);
$file = str_replace('£header', html::header(), $file);

if (isset($_POST['Accedi'])) {

    $db = new DBConnection();

    $email = trim($_POST["emailLogin"]);
    $password = trim($_POST["password"]);

    $errori = "";

    if (!$db->exitsEmail($email))
        $errori .= "<li>Verifica che l'e-mail inserita sia valida</li>";
    if (!$db->exitsPassword($password))
        $errori .= "<li>La password inserita è errata</li>";

    if ($errori != "") {
        $form = '<div class="emailLog">
                    <img src="../../images/icons/email1.png" alt="icona email">
                    <label for="emailLogin" xml:lang="en"><span xml:lang="en">E-mail</span>:</label>
                    <input type="text" name="emailLogin" id="emailLogin" value=\'$_POST["emailLogin"]\' />
             </div>
             <div class="passwordLog">
                    <img src="../../images/icons/lucchetto1.png" alt="icona password">
                    <label for="passwordLogin" xml:lang="en"><span xml:lang="en">Password</span>:</label>
                    <input type="password" name="password" id="passwordLogin" value=\'$password\' />
             </div>';
        $file = str_replace('£form', $form, $file);
        $file = str_replace('£erroriLogin', "", $file);
        $beginList = '<ul>' . $errori . '</ul>';
        $file = str_replace('£erroriLogin', $beginList, $file);
        echo $file;
    } else {
        $nickname = "SELECT 'nickname' FROM 'users' WHERE 'email'=$email AND 'password'=$password";

        $db->close();

        $_SESSION['loggato'] = true;
        $_SESSION["nickname"] = $nickname;
        header("Location: ../index.php");
    }


} else { //è la prima volta che accedo
    $form = '<div class="emailLog">
                    <img src="../../images/icons/email1.png" alt="icona email">
                    <label for="emailLogin" xml:lang="en"><span xml:lang="en">E-mail</span>:</label>
                    <input type="text" name="emailLogin" id="emailLogin" value=""/>
             </div>
             <div class="passwordLog">
                    <img src="../../images/icons/lucchetto1.png" alt="icona password">
                    <label for="passwordLogin" xml:lang="en"><span xml:lang="en">Password</span>:</label>
                    <input type="password" name="password" id="passwordLogin" value=""/>
             </div>';
    $file = str_replace('£form', $form, $file);
    $file = str_replace('£erroriLogin', "", $file);

    echo $file;

}

?>