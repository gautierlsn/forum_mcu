<?php
    //Affichage des informations du profil
    function showInfoProfile($id){
        $mdp = "******";

        echo '
        <div class="container mt-5">
            <div class="row">
                <h1 class="mx-auto text-center font50"><strong><i class="fas fa-angle-left"></i> Profil <i class="fas fa-angle-right"></i></strong></h1>
            </div>
            <div class="mt-3">
                <div>
                    <ul class="list-group-item-ul text-center">
                        <li class="list-group-item list-group-item-secondary" aria-current="true">Vos informations :</li>
                        <li class="list-group-item">Nom : '.$_SESSION['nom'].'</li>
                        <li class="list-group-item">Prénom : '.$_SESSION['prenom'].'</li>
                        <li class="list-group-item">Date de naissance : '.$_SESSION['dateNaiss'].'</li>
                        <li class="list-group-item">Email : '.$_SESSION['login'].'</li>
                        <li class="list-group-item">Mot de passe : '.$mdp.'</li>
                    </ul>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div class="row mt-3">
                <a href="update_profile.php" class="btn btn-perso-blue btn-lg mx-auto">Modifier <i class="fas fa-user-edit" id="turn"></i></i></a>
            </div>
        </div>
    </body>
    </html>
        ';
    }

    //Section pour rédiger un commentaire
    function postComments($idDiscussion){
        echo '
                <div class="header pb-4 comment_tilte text-center" style="padding-top: 5%;">
                    <h1>Espace commentaire</h1>
                </div>
                <div class="container">
                    <div class="align-items-center">
                        <form action="../script/do_add.php?action=addComment" method="POST">
                            <input type="hidden" value="'.$idDiscussion.'" name="idDiscussion">
                            <textarea name="contenu" required id="editor1" class="form-control"></textarea>
                            <div class="mx-auto text-center" style="padding-top: 1%">
                                <button type="submit" name="submit" class="btn btn-perso-green btn-lg">Envoyer <i class="fas fa-paper-plane" id="turn"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            ';
    }

    //Section pour voir une discussion
    function viewDiscussion($idDiscussion, $discussion, $comments){
        echo '
                <div class="container mt-5">

                        <div class="card">
                
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 35px; text-align: center;">'.$discussion['titre'].'</h5>
                </div>
                
                <div class="modal-footer">
                    <p style="font-weight: bold">Discussion créée par : </p> <p>'.$discussion['nom'].' '.$discussion['prenom'].'</p>
                    <br/>
                    <p style="font-weight: bold"> Date de création : <p/> <p>'.$discussion['date_creation_fr'].'</p>
                </div>

                </div>
                
                <div class="comments_article">
                    <div class="container show_article_container">';
                    postComments($idDiscussion);
        echo '
                    </div>
                </div>
            ';
                foreach ($comments as $Onecomment) {
                    $date = $Onecomment['date_creation_comment'];
                    $timestamp = strtotime($date);
                    $newDate = date('d M Y à H:i', $timestamp);

        echo '
                    <div class="acomment">
                    <h2>'.$Onecomment['prenom'].'</h2>
                    <hr>
                    <p>'.$Onecomment['contenu'].'</p>
                    <hr>
                    <p style="font-weight: bold">Posté le :</p> <p class="date_discussion">'.$newDate.'</p>
            ';
                
                    if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == 1){
        echo '
                        <a href="../script/do_delete.php?action=deleteComment&idComment='.$Onecomment['id_comment'].'&idDiscussion='.$idDiscussion.'">
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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

    function viewForum($discussions){
        echo '
            <div class="container">
                <div class="row mx-auto text-center mt-5">
                    <h1 class="mx-auto text-center font50"><strong><i class="fas fa-angle-left"></i> Forum MCU <i class="fas fa-angle-right"></i></strong></h1>
                </div>
        
                <div class="row mt-5 mb-5">
                    <a href="../web_page/create_discussion.php" class="btn btn-perso-green btn-lg mx-auto">Créer une discussion <i class="fas fa-plus-circle" id="turn"></i></a>
                </div>
        
                <div class="row mt-5">
        ';
                        foreach($discussions as $discussion){
                            $date = $discussion['date_creation'];
                            $timestamp = strtotime($date);
                            $newDate = date('d M Y', $timestamp);
        echo '
                        <div class="col-md-12 text-center pb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">'.$discussion['titre'].'</h5><hr>
                                    <p>Auteur : '.$discussion['nom'].' '.$discussion['prenom'].'</p>
                                    <p>Date de création : '.$newDate.'</p>
                                    <div class="mt-2">
                                    <a href="view_discussion.php?idDiscussion='.$discussion['id_discussion'].'" class="btn btn-perso-blue">Voir <i class="fas fa-eye" id="turn"></i></a>
        ';
                                    if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == 1){
        echo '      
                                        <a href="../script/do_delete.php?action=deleteDiscussion&idDiscussion='.$discussion['id_discussion'].'" class="btn btn-perso-red" >Supprimer <i class="fas fa-trash-alt" id="turn"></i></a>
        ';
                                    }
        echo ' 
                                    </div>
                                </div>
                            </div>
                        </div>
        ';
                    }
        echo '
                </div>
            </div>
            <a href="#" id="back-to-top" class="text-center" style="display: block;"><i class="fas fa-3x fa-chevron-circle-up"></i></a>
        ';
    }

    //Affiche le tableau pour l'adminsitrateur
    function dashboard_admin($users){
        echo '
            <div class="separator_white"></div>
            <div class="container">
                <div class="row mb-4">
                    <h1 class="mx-auto text-center font50"><strong><i class="fas fa-angle-left"></i> Admin <i class="fas fa-angle-right"></i></strong></h1>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead class="text-center">
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Date de naissance</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                    ';
                    foreach($users as $user){
                        echo '
                            <tr>
                                <td>'.$user['nom'].'</td>
                                <td>'. $user['prenom'].'</td>
                                <td>'. $user['dateNaiss'].'</td>
                                <td>'. $user['email'] . '</td>
                                <td class="width300">
                                    <a class="btn btn-perso-red" href="../script/do_delete.php?action=deleteUser&id='.$user['id_utilisateur'].'">Supprimer <i class="fas fa-trash" id="turn"></i></a>
                                </td>
                            </tr>
                        ';
                    }
                    echo'
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </body>
    </html>
        ';
    }
?>

