<?php
    session_start();
    require ('Script_PHP/function_general.php');
    require ('Script_PHP/function_bdd.php');

    makeHead("CSS/stylesheet.css","CSS/stylesheet.css","JS/jquery.js","JS/script.js");

    //Gestion du message d'erreur d'authentification
    if(isset($_SESSION['errorLogin'])){
        $msg_error = "Erreur : Identifiants / Mot de passe invalide";
        unset($_SESSION['errorLogin']);
    }
    else{
        $msg_error = "";
    }

    login_form($msg_error);
?>