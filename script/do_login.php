<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");

    //On regarde si les identifiants transmis par l'utilisateur sont bon
    if (connexion($_POST['login'], $_POST['motdepasse'])){
        session($_POST['login']);
        header("location: ../web_page/forum.php");
    }
    else{
        $_SESSION['errorLogin'] = true;
        header("location: ../index.php");
    }
?>