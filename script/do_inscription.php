<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");

    if (inscription($_POST['nom'],$_POST['prenom'],$_POST['dateNaiss'],$_POST['email'],$_POST['motdepasse'])){
        header("location: ../index.php");
    }
    else{
        $_SESSION['errorEmail'] = true;
        header("location: ../web_page/inscription.php");
    }
?>