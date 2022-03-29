<?php
    session_start();

    require("../generic/function_general.php");
    require("../generic/function_bdd.php");
    require("../generic/function_form.php");

    makeHead("../css/stylesheet.css","../js/jquery.js","../JS/script.js");
    nav("#","profile.php","admin.php","#");

    verifLogin();

    $topics = getAllTopics();
?>

    <div class="container">
        <div class="row mx-auto text-center mt-5">
            <h1 class="mx-auto text-center"><strong><i class="fas fa-angle-left"></i> Forum MCU <i class="fas fa-angle-right"></i></strong></h1>
        </div>

        <div class="row mt-5">
            <a href="create_discussion.php" class="btn btn-success text-center mx-auto">Créer une discussion <i class="fas fa-plus-circle"></i></a>
        </div>

        <div class="row mt-5">
        
            <?php foreach($topics as $topic){ ?>
                <?php 

                    $date = $topic['date_creation'];
                    $timestamp = strtotime($date);
                    $newDate = date('d M Y à H:i', $timestamp);


                ?>
                <div class="col-md-12 text-center pb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $topic['titre'] ?></h5><hr>
                            <p>Auteur : <?= $topic['nom']?> <?= $topic['prenom']?></p>
                            <p>La date de création : <?= $newDate ?></p>

                            <?php
                            if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == 1){
                            ?>       
                            <a href="view_discussion.php?idTopic=<?=$topic['id_discussion']?>" class="btn btn-warning" ><i class="fas fa-eye"></i></a>
                            <a href="../Script_PHP/do_delete.php?action=deleteDiscussion&idTopic=<?=$topic["id_discussion"]?>" class="btn btn-danger btn_home_forum" ><i class="fas fa-trash-alt"></i></a>
                            
                            <?php
                            }
                            else{
                            ?>
                                <a href="view_discussion.php?idTopic=<?=$topic['id_discussion']?>" class="btn btn-warning">Voir <i class="fas fa-eye"></i></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <a href="#" id="back-to-top" class="text-center" style="display: block;"><i class="fas fa-3x fa-chevron-circle-up"></i></a>
