<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");

    verifLogin();
    verifAdmin();

    $action = $_GET['action'];

    if($action == "deleteDiscussion"){
        $idDiscussion = $_GET['idDiscussion'];

        //Suppression d'une discussion
        doDeleteDiscussion($idDiscussion);

        header("location: ../web_page/forum.php");
    }

    if($action == "deleteComment"){
        $idComment = $_GET['idComment'];
        $idDiscussion = $_GET['idDiscussion'];

        //Suppression d'un commentaire
        doDeleteComment($idComment);

        header("location: ../web_page/view_discussion.php?idDiscussion=$idDiscussion");
    }

    if($action == "deleteUser"){
        $id = checkInput($_GET['id']);

        //Suppression d'un utilisateur
        doDeleteUser($id);

        header("location: ../web_page/admin.php");
    }
?>