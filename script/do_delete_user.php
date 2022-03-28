<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");

    makeHead("../CSS/bootstrap.min.css","../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");

    verifLogin();
    verifAdmin();

    $id = checkInput($_GET['id']);

    //Suppression d'un utilisateur
    doDeleteUtilisateur($id);

    header("location: ../web_page_admin/admin.php");
?>
