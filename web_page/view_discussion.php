<?php
session_start();
require("../Script_PHP/function_general.php");
require("../Script_PHP/function_bdd.php");
makeHead("../CSS/stylesheet.css", "../CSS/stylesheet.css", "../JS/jquery.js", "../JS/script.js");
nav("forum.php", "profile.php", "../web_page_admin/admin.php", "#");
verifLogin();
$idTopic = $_GET['idTopic'];
$topic = getOneTopic($idTopic);
$comments = getAllCommentsByTopics($idTopic);
?>


<div class="container mt-5">

    <div class="card">

        <div class="card-body">
            <h5 class="card-title" style="font-size: 35px; text-align: center;"><?= $topic["titre"] ?></h5>
        </div>

        <div class="modal-footer">
            <p style="font-weight: bold">Discussion créée par : </p> <p><?= $topic["nom"] ?> <?= $topic["prenom"] ?></p>
            <br/>
            <p style="font-weight: bold"> Date de création : <p/> <p><?= $topic["date_creation_fr"] ?></p>
        </div>

    </div>

    <h4 class="text-center mt-5">Espace commentaire</h4>

    <div class="comments_article">
        <div class="container show_article_container">
            <?php include("view-parts/formComments.php") ?>
        </div>
    </div>


    <?php
    foreach ($comments as $Onecomment) {
        $date = $Onecomment['date_creation_message'];
        $timestamp = strtotime($date);
        $newDate = date('d M Y à H:i', $timestamp);
        ?>
        <div class="acomment">
        <h2><?php echo $Onecomment['prenom'] ?></h2>
        <hr>
        <p><?= $Onecomment['contenu'] ?></p>
        <hr>
        <p style="font-weight: bold">Posté le :</p> <p class="date_topic"><?php echo $newDate ?></p>

        <?php if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == 1) { ?>
            <a href="../Script_PHP/do_delete.php?action=deleteMessage&idMessage=<?= $Onecomment["id_message"] ?>&idTopic=<?= $idTopic ?>">
                <button class="btn btn-danger btn_show_topic"><i class="fas fa-trash-alt"></i></button>
            </a>

            <?php
        }
        ?></div><?php
    }

    ?>


</div>





