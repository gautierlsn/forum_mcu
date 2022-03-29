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
?>

