<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_form.php");

    makeHead("../css/stylesheet.css","../js/jquery.js","../js/script.js");
    nav("forum.php","profile.php","admin.php","#");

    verifLogin();

    //Formulaire de création d'une discussion
    createDiscussionForm($_SESSION['id']);
?>
