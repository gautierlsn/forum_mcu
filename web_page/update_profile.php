<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_form.php");

    makeHead("../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");
    nav("forum.php","profile.php","../web_page_admin/admin.php","#");

    verifLogin();

    $nameError = $prenomError = $adresseError = $loginError = $mdpError = "";

    if(!empty($_POST)){
        $nom = checkInput($_POST['nom']);
        $prenom = checkInput($_POST['prenom']);
        $dateNaiss = checkInput($_POST['dateNaiss']);
        $email = checkInput($_POST['email']);
        $mdp = checkInput($_POST['mdp']);
        $isSuccess = true;
        if(empty($nom)){
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($prenom)){
            $prenomError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($dateNaiss)){
            $adresseError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($email)){
            $loginError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($mdp)){
            $mdpError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if($isSuccess){
            //Modification du profil
            doUpdateProfile($nom,$prenom,$dateNaiss,$email,$mdp,$_SESSION['id']);
            header("Location: profile.php");
        }
    }

    $user = getUserInfo();

    //Formulaire pour modifier les informations du profil
    updateProfileForm($user, $nameError,$prenomError,$adresseError,$loginError,$mdpError);
?>
