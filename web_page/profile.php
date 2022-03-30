<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_form.php");
    require("../generic/function_display.php");

    makeHead("../css/stylesheet.css","../js/jquery.js","../js/script.js");
    nav("forum.php","#","admin.php","#");

    verifLogin();

    //Affiche les informations de l'utilisateur
    showInfoProfile($_SESSION['id']);
?>
