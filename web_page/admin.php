<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_form.php");

    makeHead("../css/stylesheet.css","../js/jquery.js","../js/script.js");
    nav("../web_page/forum.php","../web_page/profile.php","#","#");

    verifLogin();
    verifAdmin();

    //Affichage du dashboard adminstrateur
    dashboard_admin();
?>
