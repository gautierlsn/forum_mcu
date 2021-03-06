<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");

    verifLogin();

    $action = $_GET['action'];

    if($action == "addDiscussion"){
        $contenu = $_POST['contenu'];
        $id = $_GET['id'];

        //Ajout d'une discussion
        doAddDiscussion($contenu,$id);

        header("location: ../web_page/forum.php");
    }

    if($action == "addComment"){
        $id_discussion = $_POST['idDiscussion'];
        $contenu = $_POST['contenu'];
        $id_utilisateur = $_SESSION['id'];

        //Ajout d'un commentaire
        doAddComment($id_discussion,$contenu,$id_utilisateur);

        header("location: ../web_page/view_discussion.php?idDiscussion=$id_discussion");
    }
?>