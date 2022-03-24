<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");

    $id_discussion = $_POST['idTopic'];
    $contenu = $_POST['contenu'];
    $date_creation_message = date("Y-m-d");
    $id_utilisateur = $_SESSION['id'];

    echo $id_discussion;
    echo $contenu;
    echo $date_creation_message;
    echo $id_utilisateur;

    doAddComment($id_discussion,$contenu,$date_creation_message,$id_utilisateur);
    header("location: ../web_page/view_discussion.php?idTopic=2");
?>