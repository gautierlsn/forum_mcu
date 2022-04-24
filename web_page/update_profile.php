<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_form.php");

    makeHead("../css/stylesheet.css","../js/jquery.js","../js/script.js");
    menu("forum.php","profile.php","admin.php","#");

    verifLogin();

    $user = getUserInfo();

    //Formulaire pour modifier les informations du profil
    updateProfileForm($user);
?>
