<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");

    verifLogin();
    verifAdmin();

    $action = $_GET['action'];

    if($action == "deleteDiscussion"){
        $idTopic = $_GET['idTopic'];

        //Suppression d'une discussion
        doDeleteDiscussion($idTopic);

        header("location: ../web_page/forum.php");
    }

    if($action == "deleteMessage"){
        $idMessage = $_GET['idMessage'];

        //Suppression d'un commentaire
        doDeleteMessage($idMessage);

        header("location: ../web_page/view_discussion.php?idTopic=$idTopic");
    }

    if($action == "deleteUser"){
        $id = checkInput($_GET['id']);

        //Suppression d'un utilisateur
        doDeleteUtilisateur($id);

        header("location: ../web_page/admin.php");
    }
?>