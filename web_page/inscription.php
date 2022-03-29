<?php
    session_start();

    require ('../generic/function_general.php');
    require ('../generic/function_bdd.php');
    require ('../generic/function_form.php');

    makeHead("../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");

    //Gestion du message d'erreur d'authentification
    if(isset($_SESSION['errorLogin'])){
        $msg_error = "Erreur : Identifiants / Mot de passe invalide";
        unset($_SESSION['errorLogin']);
    }
    else{
        $msg_error = "";
    }

    register_form($msg_error);
?>