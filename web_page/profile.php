<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_form.php");
    require("../generic/function_display.php");

    makeHead("../css/stylesheet.css","../js/jquery.js","../js/script.js");
    menu("forum.php","#","admin.php","#");

    verifLogin();

    $user = getUserInfo();

    //Affichage des informations de l'utilisateur
    showInfoProfile($user);
?>
