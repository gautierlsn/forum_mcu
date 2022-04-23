<?php
    session_start();

    require ('generic/function_general.php');
    require ('generic/function_bdd.php');
    require ('generic/function_form.php');

    makeHead("css/stylesheet.css","js/jquery.js", "js/script.js");

    if(isset($_SESSION['errorLogin'])){
        $msg_error = "L'email ou le mot de passe est incorrect !";
        unset($_SESSION['errorLogin']);
    }
    else{
        $msg_error = "";
    }

    login_form($msg_error);
?>