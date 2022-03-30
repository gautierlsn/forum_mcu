<?php
    session_start();

    require ('../generic/function_general.php');
    require ('../generic/function_bdd.php');
    require ('../generic/function_form.php');

    makeHead("../css/stylesheet.css","../js/jquery.js","../js/script.js");

    if(isset($_SESSION['errorEmail'])){
        $msg_error = "Cet email est déjà utilisé !";
        unset($_SESSION['errorEmail']);
    }
    else{
        $msg_error = "";
    }

    register_form($msg_error);
?>