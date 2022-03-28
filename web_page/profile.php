<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_form.php");

    makeHead("../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");
    nav("forum.php","#","../web_page_admin/admin.php","#");

    verifLogin();

    //Affiche les informations de l'utilisateur
    showInfoProfile($_SESSION['id']);
?>
