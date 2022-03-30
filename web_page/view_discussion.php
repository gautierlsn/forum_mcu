<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_display.php");

    makeHead("../css/stylesheet.css", "../js/jquery.js", "../js/script.js");
    nav("forum.php", "profile.php", "admin.php", "#");

    verifLogin();

    $idTopic = $_GET['idTopic'];
    $topic = getOneTopic($idTopic);
    $comments = getAllCommentsByDiscussion($idTopic);

    viewDiscussion($idTopic, $topic, $comments);

    require("../js/CKeditor.php");
?>








