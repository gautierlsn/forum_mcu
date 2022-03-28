<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");
    makeHead("../CSS/stylesheet.css","../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");
    nav("forum.php","#","../web_page_admin/admin.php","#");
    verifLogin();
    
    createDiscussionForm($_SESSION['id']);
?>
