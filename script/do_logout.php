<?php
    session_start();

    //On supprime la session en cours
    if(session_destroy()) {
        header('location: ../index.php');
    }
?>