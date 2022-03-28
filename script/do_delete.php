<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");

    $action = $_GET['action'];
    $idTopic = $_GET['idTopic'];
    $idMessage = $_GET['idMessage'];

    if($action == "deleteDiscussion"){
        doDeleteDiscussion($idTopic);
        header("location: ../web_page/forum.php");
    }

    if($action == "deleteMessage"){
        doDeleteMessage($idMessage);
        header("location: ../web_page/view_discussion.php?idTopic=$idTopic");
    }
    
?>