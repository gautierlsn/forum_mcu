<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_form.php");

    makeHead("../css/stylesheet.css","../js/jquery.js","../js/script.js");
    nav("forum.php","#","admin.php","#");

    verifLogin();
    
    createDiscussionForm($_SESSION['id']);
?>
