<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");

    $action = $_GET['action'];
    $contenu = $_POST['contenu'];
    $id = $_GET['id'];

    echo $action;
    echo $contenu;
    echo $id;

    echo date("Y-m-d");

    if($action == "addDiscussion"){
        doAddDiscussion($contenu,$id);
        header("location: ../web_page/forum.php");
    }

    /*if($action == "deleteMessage"){
        doDeleteMessage($idMessage);
        header("location: ../web_page/view_discussion.php?idTopic=$idTopic");
    }*/
    
?>