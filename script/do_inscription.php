<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");

    inscription($_POST['nom'],$_POST['prenom'],$_POST['dateNaiss'],$_POST['email'],$_POST['motdepasse']);
    header("location: ../index.php");
?>