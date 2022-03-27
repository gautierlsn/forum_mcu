<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");
    makeHead("../CSS/stylesheet.css","../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");
    nav("../web_page/forum.php","../web_page/profile.php","#","#");
    verifLogin();
    verifAdmin();
    //Affichage du dashboard adminstrateur
    dashboard_admin();
?>
