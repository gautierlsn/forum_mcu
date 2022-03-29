<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");

    //Test pour savoir si les identifiants correspondent à la Bdd
    if ($exist = connexion($_POST['login'], $_POST['motdepasse'])){
        session($_POST['login']);
        header("location: ../web_page/forum.php");
    }
    else{
        $_SESSION['errorLogin'] = true;
        header("location: ../index.php");
    }
?>