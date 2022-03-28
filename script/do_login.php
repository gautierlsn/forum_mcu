<?php
    session_start();

    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");

    echo $_POST['login'];
    echo $_POST['motdepasse'];

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