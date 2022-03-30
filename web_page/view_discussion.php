<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_display.php");

    makeHead("../css/stylesheet.css", "../js/jquery.js", "../js/script.js");
    nav("forum.php", "profile.php", "admin.php", "#");

    verifLogin();

    $idDiscussion = $_GET['idDiscussion'];
    $discussion = getOneDiscussion($idDiscussion);
    $comments = getAllCommentsByDiscussion($idDiscussion);

    viewDiscussion($idDiscussion, $discussion, $comments);

    require("../js/CKeditor.php");
?>








