<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_display.php");

    makeHead("../css/stylesheet.css","../js/jquery.js","../js/script.js");
    menu("forum.php","profile.php","#","#");

    verifLogin();
    verifAdmin();

    $users = getUsers();

    //Affichage du dashboard adminstrateur
    dashboard_admin($users);
?>
