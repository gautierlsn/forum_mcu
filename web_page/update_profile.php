<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");
    makeHead("../CSS/bootstrap.min.css","../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");
    nav("panier.php","profile.php","pizza.php","boisson.php","dessert.php","../web_page_admin/admin.php","commande.php","profile.php");
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
    //Formulaire pour modifier les informations du profil
    updateProfileForm($nameError,$prenomError,$adresseError,$loginError,$mdpError);
?>
