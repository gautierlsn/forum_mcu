<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");
    makeHead("../CSS/bootstrap.min.css","../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");
    nav("forum.php","#","../web_page_admin/admin.php","#");
    verifLogin();
    //Affiche les informations du client
    showInfoProfile($_SESSION['id']);
?>
