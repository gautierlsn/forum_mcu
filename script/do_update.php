<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");

    verifLogin();

    $action = $_GET['action'];

    if($action == "updateProfile"){
        $nom = checkInput($_POST['nom']);
        $prenom = checkInput($_POST['prenom']);
        $dateNaiss = checkInput($_POST['dateNaiss']);
        $email = checkInput($_POST['email']);
        $mdp = checkInput($_POST['mdp']);

        //Modification du profil
        doUpdateProfile($nom,$prenom,$dateNaiss,$email,$mdp,$_SESSION['id']);

        header("Location: ../web_page/profile.php");
    }
?>