<?php
    //Affichage des informations du profil
    function showInfoProfile($user){
        $mdp = "******";
        $dateNaiss = date("d/m/Y", strtotime($user['dateNaiss']));

        echo '
        <div class="conteneur margin-top-5">
            <div class="ligne">
                <h1 class="mx-auto text-center font50"><strong><i class="fas fa-angle-left"></i> Profil <i class="fas fa-angle-right"></i></strong></h1>
            </div>
            <div class="margin-top-3">
                <div>
                    <ul class="list-group-item-ul text-center">
                        <li class="list-group-item list-group-item-secondary" aria-current="true">Vos informations :</li>
                        <li class="list-group-item">Nom : '.$user['nom'].'</li>
                        <li class="list-group-item">Prénom : '.$user['prenom'].'</li>
                        <li class="list-group-item">Date de naissance : '.$dateNaiss.'</li>
                        <li class="list-group-item">Email : '.$user['email'].'</li>
                        <li class="list-group-item">Mot de passe : '.$mdp.'</li>
                    </ul>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div class="ligne margin-top-3">
                <a href="update_profile.php" class="bouton bouton-perso-blue bouton-lg mx-auto">Modifier <i class="fas fa-user-edit turn"></i></a>
            </div>
        </div>
    </body>
    </html>
        ';
    }

    //Section pour rédiger un commentaire
    function postComments($idDiscussion){
        echo '
                <div class="header padding-bottom-4 comment_tilte text-center margin-top-5">
                    <h1>Espace commentaire</h1>
                </div>
                <div class="align-items-center">
                    <form action="../script/do_add.php?action=addComment" method="POST">
                        <input type="hidden" value="'.$idDiscussion.'" name="idDiscussion">
                        <textarea name="contenu" required id="editor1" class="form-control"></textarea>
                        <div class="mx-auto text-center">
                            <button type="submit" name="submit" class="bouton bouton-perso-green bouton-lg">Envoyer <i class="fas fa-paper-plane turn"></i></button>
                        </div>
                    </form>
                </div>
            ';
    }

    //Section pour voir une discussion
    function viewDiscussion($idDiscussion, $discussion, $comments){
        echo '
                <div class="conteneur margin-top-5">

                        <div class="card">
                
                            <div class="card-body">
                                <h1 class="card-title text-center">'.$discussion['titre'].'</h1>
                </div>
                
                <div class="modal-footer">
                    <p><span class="bold">Auteur : </span>'.$discussion['nom'].' '.$discussion['prenom'].'</p>
                    <p><span class="bold">Date de création : </span>'.$discussion['date_creation_fr'].'</p>
                </div>

                </div>
                
                <div class="comments_article">';
                    postComments($idDiscussion);
        echo '
                </div>
                <div class="separator_white"></div>
            ';
                foreach ($comments as $Onecomment) {

        echo '
                    <div class="acomment comment-width-reduct padding-bottom-5">
                    <p><span class="bold">Auteur : </span>'.$Onecomment['nom'].' '.$Onecomment['prenom'].'</p>
                    <p><span class="bold">Date de création : </span>'.$Onecomment['date_creation_comment_fr'].'</p>
                    <hr>
                    <div class="text-center font30">'.$Onecomment['contenu'].'</div>
                    <hr>
            ';
                
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 1){
        echo '
                    <div class="text-center">
                        <a href="../script/do_delete.php?action=deleteComment&idComment='.$Onecomment['id_comment'].'&idDiscussion='.$idDiscussion.'"
                            class="bouton bouton-perso-red">Supprimer <i class="fas fa-trash-alt turn"></i>
                        </a>
                    </div>
            ';
                    }
        echo '
                    </div>
            ';
                }

        echo ' 
                </div>
                <a href="#" id="back-to-top" class="text-center"><i class="fas fa-3x fa-chevron-circle-up"></i></a>
        ';
        require("../js/CKeditor.php");
    }

    function viewForum($discussions){
        echo '
            <div class="conteneur">
                <div class="ligne mx-auto text-center margin-top-5">
                    <h1 class="mx-auto text-center font50"><strong><i class="fas fa-angle-left"></i> Forum MCU <i class="fas fa-angle-right"></i></strong></h1>
                </div>
        
                <div class="ligne margin-top-3 margin-bottom-5">
                    <a href="../web_page/create_discussion.php" class="bouton bouton-perso-green bouton-lg mx-auto">Créer une discussion <i class="fas fa-plus-circle turn"></i></a>
                </div>
        
                <div class="ligne margin-top-5">
        ';
                        foreach($discussions as $discussion){
        echo '
                        <div class="colonne-12 text-center padding-bottom-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">'.$discussion['titre'].'</h5><hr>
                                    <p><span class="bold">Auteur : </span>'.$discussion['nom'].' '.$discussion['prenom'].'</p>
                                    <p><span class="bold">Date de création : </span> '.$discussion['date_creation_fr'].'</p>
                                    <div class="margin-top-2">
                                    <a href="view_discussion.php?idDiscussion='.$discussion['id_discussion'].'" class="bouton bouton-perso-blue">Voir <i class="fas fa-eye turn"></i></a>
        ';
                                    if (isset($_SESSION['role']) && $_SESSION['role'] == 1){
        echo '      
                                        <a href="../script/do_delete.php?action=deleteDiscussion&idDiscussion='.$discussion['id_discussion'].'" class="bouton bouton-perso-red" >Supprimer <i class="fas fa-trash-alt turn"></i></a>
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
            <a href="#" id="back-to-top" class="text-center"><i class="fas fa-3x fa-chevron-circle-up"></i></a>
        ';
    }

    //Affiche le tableau pour l'adminsitrateur
    function dashboard_admin($users){
        echo '
            <div class="separator_white"></div>
            <div class="conteneur">
                <div class="ligne mb-4">
                    <h1 class="mx-auto text-center font50"><strong><i class="fas fa-angle-left"></i> Admin <i class="fas fa-angle-right"></i></strong></h1>
                </div>
                <div class="ligne">
                    <div class="colonne-12">
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
                        $date_fr = date("d/m/Y", strtotime($user['dateNaiss']));
                        echo '
                            <tr>
                                <td>'.$user['nom'].'</td>
                                <td>'. $user['prenom'].'</td>
                                <td>'. $date_fr.'</td>
                                <td class="font11">'. $user['email'] . '</td>
                                <td>
                                    <a class="bouton-admin bouton-perso-red-admin" href="../script/do_delete.php?action=deleteUser&id='.$user['id_utilisateur'].'"><i class="fas fa-trash turn"></i></a>
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
        </body>
    </html>
        ';
    }
?>

