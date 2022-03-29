<?php
    //Affichage des informations du profil
    function showInfoProfile($id){
        $db = Database::connect();
        $statement = $db->prepare("SELECT nom, prenom, dateNaiss, email FROM utilisateur where id_utilisateur = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $mdp = "******";
        Database::disconnect();

        echo '
        <div class="mini_separator_white"></div>
        <div class="container">
            <div class="row">
                <h1 class="mx-auto text-center"><strong><i class="fas fa-angle-left"></i> Profil <i class="fas fa-angle-right"></i></strong></h1>
            </div>
            <div>
                <div>
                    <ul class="list-group-item-ul text-center">
                        <li class="list-group-item list-group-item-secondary" aria-current="true">Vos informations :</li>
                        <li class="list-group-item">Nom : '.$item['nom'].'</li>
                        <li class="list-group-item">Prénom : '.$item['prenom'].'</li>
                        <li class="list-group-item">Date de naissance : '.$item['dateNaiss'].'</li>
                        <li class="list-group-item">Email : '.$item['email'].'</li>
                        <li class="list-group-item">Mot de passe : '.$mdp.'</li>
                    </ul>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div class="row mt-5">
                <a href="update_profile.php" class="btn btn-primary btn-lg text-center mx-auto">Modifier <i class="fas fa-user-edit"></i></i></a>
            </div>
        </div>
    </body>
    </html>
        ';
    }

    function viewDiscussion($idTopic, $topic, $comments){
        echo '
                <div class="container mt-5">

                        <div class="card">
                
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 35px; text-align: center;">'.$topic['titre'].'</h5>
                </div>
                
                <div class="modal-footer">
                    <p style="font-weight: bold">Discussion créée par : </p> <p>'.$topic['nom'].' '.$topic['prenom'].'</p>
                    <br/>
                    <p style="font-weight: bold"> Date de création : <p/> <p>'.$topic['date_creation_fr'].'</p>
                </div>

                </div>
                
                <div class="comments_article">
                    <div class="container show_article_container">';
                        formComments($idTopic);
        echo '
                    </div>
                </div>
            ';
                foreach ($comments as $Onecomment) {
                    $date = $Onecomment['date_creation_message'];
                    $timestamp = strtotime($date);
                    $newDate = date('d M Y à H:i', $timestamp);

        echo '
                    <div class="acomment">
                    <h2>'.$Onecomment['prenom'].'</h2>
                    <hr>
                    <p>'.$Onecomment['contenu'].'</p>
                    <hr>
                    <p style="font-weight: bold">Posté le :</p> <p class="date_topic">'.$newDate.'</p>
            ';
                
                    if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == 1){
        echo '
                        <a href="../script/do_delete.php?action=deleteMessage&idMessage='.$Onecomment['id_message'].'&idTopic='.$idTopic.'">
                            <button class="btn btn-danger btn_show_topic"><i class="fas fa-trash-alt"></i></button>
                        </a>
            ';
                    }
        echo '
                    </div>
            ';
                }

        echo ' 
                </div>
        ';
    }

    function formComments($idTopic){
        echo '
            <div class="header pb-4 comment_tilte text-center" style="padding-top: 5%;">
                <h2>Poster un commentaire</h2>
            </div>
            <div class="container">
                <div class="align-items-center">
                    <form action="../script/do_add.php" method="POST">
                        <input type="hidden" value="'.$idTopic.'" name="idTopic">
                        <textarea name="contenu" required id="editor1" class="form-control"></textarea>
                        <div class="mx-auto text-center" style="padding-top: 1%">
                            <input type="submit" name="submit" class="btn btn-primary" value="Send Request">
                        </div>
                    </form>
                </div>
            </div>
        ';
    }
?>

