<?php
require 'database.php';

//Connexion de l'utilisateur
function connexion($email,$mdp){
    $db = Database::connect();
    $statement = $db->prepare("SELECT count(*) as nb FROM utilisateur WHERE email=? AND mdp=?");
    $statement->execute(array($email,$mdp));
    $results = $statement->fetch();
    Database::disconnect();
    return $results['nb'];
}

//Inscription de l'utilisateur
function inscription($nom, $prenom, $dateNaiss, $email, $motdepasse){
    $db = Database::connect();
    $statement = $db->prepare("INSERT INTO utilisateur (nom,prenom,dateNaiss,email,mdp,role) values(?, ?, ?, ?, ?, ?)");
    $statement->execute(array($nom, $prenom, $dateNaiss, $email, $motdepasse, 0));
    Database::disconnect();
}

//Session de l'utilisateur
function session($login){
    $db = Database::connect();
    $statement = $db->prepare("SELECT id_utilisateur, nom, prenom, dateNaiss, email, role FROM utilisateur WHERE email =?");
    $statement->execute(array($login));
    $results = $statement->fetch();
    $_SESSION['id'] = $results['id_utilisateur'];
    $_SESSION['login'] = $results['email'];
    $_SESSION['admin'] = $results['role'];
    $_SESSION['nom'] = $results['nom'];
    $_SESSION['prenom'] = $results['prenom'];
    $_SESSION['ROLE'] = $results['role'];
    Database::disconnect();
}

//Vérification si l'utilisateur est bel et bien connecté
function verifLogin(){
    if (!isset($_SESSION['login'])){
        header("Location: ../index.php");
    }
}

//Vérification si l'utilisateur est bel et bien connecté en tant que professeur
function verifAdmin(){
    if (!$_SESSION['admin'] == 1){
        header("Location: ../Script_PHP/logout.php");
    }
}


function getAllTopics(){
    $db = Database::connect();
    $request_get_topics = $db->query(
        'SELECT id_discussion, titre, date_creation, D.id_utilisateur, U.nom, U.prenom
        FROM discussion D, utilisateur U
        WHERE D.id_utilisateur = U.id_utilisateur
        ');
    $all = $request_get_topics->fetchAll();
    return $all;
}


function getOneTopic($idTopic){
    $db = Database::connect();
    $statement = $db->prepare(
        'SELECT id_discussion, titre, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%i\') AS date_creation_fr, D.id_utilisateur, U.nom, U.prenom
        FROM discussion D, utilisateur U
        WHERE D.id_utilisateur = U.id_utilisateur
        AND id_discussion = ?;
        ');
    
    $statement->execute(array($idTopic));
    $results = $statement->fetch();
    Database::disconnect();
    return $results;
}

function getAllCommentsByTopics($IdTopics){
    $db = Database::connect();
    $request_get_comments = $db->prepare(
        'SELECT id_message, contenu, date_creation_message, id_discussion, M.id_utilisateur, U.nom, U.prenom
        FROM message M, utilisateur U
        WHERE M.id_utilisateur = U.id_utilisateur
        AND id_discussion = ? 
        ORDER BY date_creation_message DESC');
    $request_get_comments->execute(array($IdTopics));
    $all = $request_get_comments->fetchAll();
    return $all;
}

//Suppression d'une discussion
function doDeleteDiscussion($id){
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM message WHERE id_discussion = ?");
    $statement->execute(array($id));

    $statementt = $db->prepare("DELETE FROM discussion WHERE id_discussion = ?");
    $statementt->execute(array($id));
    Database::disconnect();
}

//Suppression d'un message
function doDeleteMessage($id){
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM message WHERE id_message = ?");
    $statement->execute(array($id));
    Database::disconnect();
}

//Suppression d'un utilisateur
function doDeleteUtilisateur($id){
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM utilisateur WHERE id_utilisateur = ?");
    $statement->execute(array($id));
    Database::disconnect();
}

//Inscription de l'utilisateur
function doAddDiscussion($contenu,$id){
    $db = Database::connect();
    $date_creation = date("Y-m-d");
    $statement = $db->prepare("INSERT INTO discussion (titre,date_creation,id_utilisateur) values(?, ?, ?)");
    $statement->execute(array($contenu,$date_creation,$id));
    Database::disconnect();
}

//Ajouter un commentaire à une discussion
function doAddComment($id_discussion,$contenu,$date_creation_message,$id_utilisateur){
    $db = Database::connect();
    $statement = $db->prepare("INSERT INTO message (contenu,date_creation_message,id_discussion,id_utilisateur) values(?, ?, ?, ?)");
    $statement->execute(array($contenu,$date_creation_message,$id_discussion,$id_utilisateur));
    Database::disconnect();
}

//Formulaire pour modifier les informations du profil
function createDiscussionForm($id){
    echo '
        <div class="mini_separator_white"></div>
        <div class="container">
            <div class="row">
                <h1 class="text-center mx-auto font50">Créer votre discussion</h1><hr>
            </div>
            <div class="row mt-4">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <form class="form" action="../Script_PHP/do_add.php?action=addDiscussion&id='.$id.'" role="form" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="contenu" class="form-label" >Contenu :</label>
                            <input type="text" class="form-control" id="contenu" name="contenu">
                        </div>
                        <div class="row">
                            <div class="form-actions mx-auto mt-3">
                                <a class="btn btn-primary" href="forum.php">Retour <i class="fas fa-arrow-alt-circle-left"></i></a>
                                <button type="submit" class="btn btn-primary">Créer <i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </body>
    </html>
    ';
}

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

































































//Renvoie true ou false si un nombre
function est_multiple($nombre, $multiple){
    if($nombre % $multiple == 0)
        return true;
    else
        return false;
}

/*----------------------------------------------------------------------------------------------------------------------------------------------------*/

//Affiche toutes les cartes produits de la catégorie
function showAllProduit($category,$id_client){
    $id = 0;
    $name = "";
    switch ($category) {
        case "pizza":
            $id = 1;
            $name = "Pizza";
            break;
        case "dessert":
            $id = 2;
            $name = "Dessert";
            break;
        case "boisson":
            $id = 3;
            $name = "Boisson";
            break;
    }
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM produit WHERE id_categorie =?");
    $statement->execute(array($id));
    $i = 1;
    echo'
    <div class="mini_separator_white"></div>
    <div class="container">
    <div class="row">
        <h1 class="mx-auto text-center mb-5"><strong><i class="fas fa-angle-left"></i> '.$name.' <i class="fas fa-angle-right"></i></strong></h1>
    </div>
    ';
    while($row = $statement->fetch()){
        if($i == 1 || est_multiple($i,4)){
            echo '<div class="row pb-4">';
        }
        echo'
        <div class="col-md-4">
            <div class="card border-card">
                <img src="'.$row['image'].'" class="card-img-top border-img" alt="...">
                <div class="card-body">
                    <h5 class="card-title title_produit"><strong>'.$row['libelle'].'</strong></h5>
                    <p class="card-text">'.$row['description'].'</p>
                    <p class="price"><strong>'.$row['prix'].' <i class="fas fa-euro-sign"></i></strong></p>
                    <a href="../web_page/add_panier.php?id_produit='.$row['id_produit'].'&id_client='.$id_client.'" class="btn btn-primary block">Ajouter au panier <i class="fas fa-cart-plus"></i></a>
                </div>
            </div>
        </div>';
        if(est_multiple($i,3)){
            echo '</div>';
        }
        $i++;
    }
    echo '</div>
    </body>
</html>';
    Database::disconnect();
}

//Affiche seulement un produit
function showProduit($id){
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM produit WHERE id_produit =?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    echo'
            <div class="mini_separator_white"></div>
            <div class="card border-card3">
                <img src="'.$item['image'].'" class="card-img-top border-img" alt="...">
                <div class="card-body">
                    <h5 class="card-title title_produit">'.$item['libelle'].'</h5>
                    <p class="card-text">'.$item['description'].'</p>
                    <p class="price"><strong>'.$item['prix'].' <i class="fas fa-euro-sign"></i></strong></p>
                    <a href="#" class="btn btn-primary block">Ajouter au panier <i class="fas fa-cart-plus"></i></a>
                </div>
            </div>
            <div class="row mx-auto">
                <div class="form-actions mx-auto mt-5">
                    <a class="btn btn-primary" href="admin.php">Retour <i class="fas fa-arrow-alt-circle-left"></i></a>
                </div>
            </div>
        </body>
        </html>
        ';
    Database::disconnect();
}

//Affiche le tableau pour l'adminsitrateur
function dashboard_admin(){
    $db = Database::connect();
    $statement = $db->query('SELECT * 
                            FROM utilisateur');
    echo '
        <div class="mini_separator_white"></div>
        <div class="container">
        <div class="row mb-4">
            <h1 class="mx-auto text-center"><strong><i class="fas fa-angle-left"></i> Admin <i class="fas fa-angle-right"></i></strong></h1>
        </div>
        <table class="table table-striped table-bordered responsive">
            <thead class="text-center">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="text-center">
    ';
            while($item = $statement->fetch()){
                echo '<tr>';
                echo '<td>'. $item['nom'] . '</td>';
                echo '<td>'. $item['prenom'] . '</td>';
                echo '<td>'. $item['dateNaiss'] . '</td>';
                echo '<td>'. $item['email'] . '</td>';
                echo '<td class="width300">';
                echo '<a class="btn btn-danger" href="../web_page_admin/delete.php?id='.$item['id_utilisateur'].'">Supprimer <i class="fas fa-trash"></i></a>';
                echo '</td>';
                echo '</tr>';
            }
    echo'
            </tbody>
        </table>
    </div>
    </body>
</html>
    ';
    Database::disconnect();
}

//Affiche le tableau du panier
function panier($id){
    $db = Database::connect();
    $statement = $db->prepare("SELECT PR.id_produit, libelle, prix, libelle_categorie, quantite 
                                     FROM acheter A, produit PR, categorie_produit CA
                                     WHERE A.id_produit = PR.id_produit
                                     AND PR.id_categorie = CA.id_categorie
                                     AND id_client = ?
                                     ORDER BY prix DESC;");
    $statement->execute(array($id));
    $idClient = $_SESSION['id'];
    $statementt = $db->prepare("SELECT count(*) as nb FROM acheter WHERE id_client = ?");
    $statementt->execute(array($id));
    $results = $statementt->fetch();
    $result = $results['nb'];

    $total = 0;
    $statementtt = $db->prepare("SELECT A.id_produit, P.prix, A.quantite
                                      FROM acheter A, produit P
                                      WHERE A.id_produit = P.id_produit
                                      AND A.id_client = ?");
    $statementtt->execute(array($id));
    while ($item = $statementtt->fetch()) {
        $total = $total + $item['prix'] * $item['quantite'];
    }

    if($result != 0) {
        echo '
        <div class="mini_separator_white"></div>
        <div class="container">
        <div class="row">
            <h1 class="mx-auto text-center"><strong><i class="fas fa-angle-left"></i> Panier <i class="fas fa-angle-right"></i></strong></h1>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="text-center">
            <tr>
                <th>N°</th>
                <th>Libelle</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Quantite</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="text-center">
    ';
        $i = 1;
        while ($item = $statement->fetch()) {
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$item['libelle'].'</td>';
            echo '<td>'.number_format($item['prix'], 1, '.', '') . ' €</td>';
            echo '<td>'.$item['libelle_categorie'].'</td>';
            echo '<td>'.$item['quantite'].'</td>';
            echo '<td><a class="btn btn-danger" href="../web_page/deleteProduitPanier.php?id_client='.$idClient.'&id_produit='.$item['id_produit'].'">Delete <i class="fas fa-trash"></i></a></td>';
            echo '</tr>';
            $i++;
        }
        echo '
            <tr>
                <td colspan="6"><p class="font30"><strong>Prix Total : '.$total.' €</strong></p></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row mt-5">
        <a href="add_commande.php?prix_total='.$total.'" class="btn btn-success btn-lg text-center mx-auto">Valider mon panier <i class="fas fa-check-circle"></i></a>
    </div>
    </body>
</html>
    ';
    }
    else{
        echo '
        <div class="mini_separator_white"></div>
        <div class="container">
            <div class="row mb-5">
                <h1 class="mx-auto text-center"><strong><i class="fas fa-angle-left"></i> Panier <i class="fas fa-angle-right"></i></strong></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <p class="font50">Votre panier est tristement vide</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="text-center">
                        <p class="font50 mt-5"><i class="fas fa-sad-cry fa-3x"></i></p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <a href="pizza.php" class="btn btn-primary btn-lg text-center mx-auto"></span>Commander <i class="fas fa-angle-double-right"></i></i></a>
            </div>
        </div>
        </div>
    </body>
</html>
        ';
    }
    Database::disconnect();
}

//Affiche le tableau des commandes
function commande($id){
    $db = Database::connect();
    $statement = $db->prepare("SELECT CO.date_commande, CO.statut, CLI.id_client, CLI.nom, CLI.prenom, CO.prix_total
                                     FROM commande CO, client CLI
                                     WHERE CO.id_client = CLI.id_client
                                     AND CO.id_client = 1;");
    $statement->execute(array($id));

    $statementt = $db->prepare("SELECT count(*) as nb FROM commande WHERE id_client = ?");
    $statementt->execute(array($id));
    $results = $statementt->fetch();
    $result = $results['nb'];

    if($result != 0) {
        echo '
        <div class="mini_separator_white"></div>
        <div class="container">
        <div class="row">
            <h1 class="mx-auto text-center"><strong><i class="fas fa-angle-left"></i> Commande <i class="fas fa-angle-right"></i></strong></h1>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="text-center">
            <tr>
                <th>N°</th>
                <th>Date et heure</th>
                <th>Client</th>
                <th>Prix Total</th>
                <th>Statut</th>
            </tr>
            </thead>
            <tbody class="text-center">
    ';
        $i = 1;
        while ($item = $statement->fetch()) {
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$item['date_commande'].'</td>';
            echo '<td>'.$item['nom'].' '.$item['prenom'].'</td>';
            echo '<td>'.$item['prix_total'].' €</td>';
            echo '<td>'.$item['statut'].'</td>';
            echo '</tr>';
            $i++;
        }
        echo '
            </tbody>
        </table>
    </div>
    </body>
</html>
    ';
    }
    else{
        echo '
        <div class="mini_separator_white"></div>
        <div class="container">
            <div class="row mb-5">
                <h1 class="mx-auto text-center"><strong><i class="fas fa-angle-left"></i> Commande <i class="fas fa-angle-right"></i></strong></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <p class="font50">Vous n\'avez effectuez aucune commande !</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="text-center">
                        <p class="font50 mt-5"><i class="fas fa-sad-cry fa-3x"></i></p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <a href="pizza.php" class="btn btn-primary btn-lg text-center mx-auto"></span>Commander <i class="fas fa-angle-double-right"></i></i></a>
            </div>
        </div>
        </div>
    </body>
</html>
        ';
    }
    Database::disconnect();
}


//Formulaire pour ajouter un produit
function addProduitForm($nameError,$priceError,$categoryError,$imageError){
    echo '
    <div class="container">
        <div class="row">
            <h1 class="mx-auto text-center mt-5"><strong>Ajouter un produit</strong></h1>
        </div>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <form class="form" action="add.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="">
                        <span class="help-inline">'.$nameError.'</span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="">
                    </div>
                    <div class="form-group">
                        <label for="price">Prix: (en €)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="">
                        <span class="help-inline">'.$priceError.'</span>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image"> 
                        <span class="help-inline">'.$imageError.'</span>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie:</label>
                        <select class="form-control" id="category" name="category">';
                            listeCategorie();
    echo '
                        </select>
                        <span class="help-inline">'.$categoryError.'</span>
                    </div>
            <div class="row">
                    <div class="form-actions mx-auto mt-3">
                        <button type="submit" class="btn btn-primary">Ajouter <i class="fas fa-plus-circle"></i></button>
                        <a class="btn btn-primary" href="admin.php">Retour <i class="fas fa-arrow-alt-circle-left"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>';
}

//Formulaire pour modifier un produit
function updateProduitForm($id,$nameError,$priceError,$categoryError,$imageError){
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM produit where id_produit = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $id_categorie = $item['id_categorie'];
    Database::disconnect();

echo '
<body>
    <div class="container">
        <div class="row">
            <h1 class="mx-auto text-center mt-5"><strong>Modifier un produit</strong></h1>
        </div>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <form class="form" action="update.php?id='.$id.'" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="'.$item['libelle'].'">
                        <span class="help-inline">'.$nameError.'</span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="'.$item['description'].'">
                    </div>
                    <div class="form-group">
                        <label for="price">Prix: (en €)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="'.$item['prix'].'">
                        <span class="help-inline">'.$priceError.'</span>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image"> 
                        <span class="help-inline">'.$imageError.'</span>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie:</label>
                        <select class="form-control" id="category" name="category">';
                            listeCategorieUpdate($id_categorie);
            echo'
                        </select>
                        <span class="help-inline">'.$categoryError.'</span>
                    </div>
                    <div class="row">
                        <div class="form-actions mx-auto mt-3">
                            <button type="submit" class="btn btn-primary">Edit <i class="fas fa-edit"></i></button>
                            <a class="btn btn-primary" href="admin.php">Retour <i class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
';
}



//Formulaire pour modifier les informations du profil
function updateProfileForm($nameError,$prenomError,$adresseError,$loginError,$mdpError){
    $db = Database::connect();
    $statement = $db->prepare("SELECT nom, prenom, dateNaiss, email FROM utilisateur where id_utilisateur = ?");
    $statement->execute(array($_SESSION['id']));
    $item = $statement->fetch();
    $mdp = "******";
    Database::disconnect();

    echo '
        <div class="mini_separator_white"></div>
        <div class="container">
            <div class="row">
                <h1 class="text-center mx-auto font50">Modifier votre profil</h1><hr>
            </div>
            <div class="row mt-4">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <form class="form" action="update_profile.php" role="form" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nom" class="form-label" >Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="'.$item['nom'].'">
                            <span class="help-inline">'.$nameError.'</span>
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="'.$item['prenom'].'">
                            <span class="help-inline">'.$prenomError.'</span>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Email :</label>
                            <input type="text" class="form-control" id="adresse" name="dateNaiss" value="'.$item['dateNaiss'].'">
                            <span class="help-inline">'.$adresseError.'</span>
                        </div>
                        <div class="mb-3">
                            <label for="login" class="form-label">Login :</label>
                            <input type="text" class="form-control" id="login" name="email" value="'.$item['email'].'">
                            <span class="help-inline">'.$loginError.'</span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" id="password" name="mdp" value="'.$mdp.'">
                            <span class="help-inline">'.$mdpError.'</span>
                        </div>
                        <div class="row">
                            <div class="form-actions mx-auto mt-3">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                                <a class="btn btn-primary" href="profile.php">Retour <i class="fas fa-arrow-alt-circle-left"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </body>
    </html>
    ';
}



//Liste déroulante des catégories
function listeCategorie(){
    $db = Database::connect();
    foreach ($db->query('SELECT * FROM categorie_produit') as $row) {
        echo '<option value="'. $row['id_categorie'] .'">'. $row['libelle_categorie'] . '</option>';;
    }
    Database::disconnect();
}

//Liste déroulante des catégories avec catégorie pré-sélectionné
function listeCategorieUpdate($category){
    $db = Database::connect();
    foreach ($db->query('SELECT * FROM categorie_produit') as $row) {
        if($row['id_categorie'] == $category)
            echo '<option selected="selected" value="'. $row['id_categorie'] .'">'. $row['libelle_categorie'] . '</option>';
        else
            echo '<option value="'. $row['id_categorie'] .'">'. $row['libelle_categorie'] . '</option>';;
    }
    Database::disconnect();
}

/*----------------------------------------------------------------------------------------------------------------------------------------------------*/

//Ajout d'un produit
function doAddProduit($name, $price, $description, $img, $category){
    $db = Database::connect();
    $img = "../images/$img";
    $statement = $db->prepare("INSERT INTO produit (libelle,prix,description,image,id_categorie) values(?, ?, ?, ?, ?)");
    $statement->execute(array($name, $price, $description, $img, $category));
    Database::disconnect();
}

//Ajout d'un produit au panier
function doAddProduitPanier($id_client,$id_produit){
    $db = Database::connect();
    $statementt = $db->prepare("SELECT COUNT(*) AS nb FROM acheter WHERE id_client = ? AND id_produit = ?");
    $statementt->execute(array($id_client,$id_produit));
    $results = $statementt->fetch();
    $nb = $results['nb'];
    if($nb != 0){
        $statementtt = $db->prepare("UPDATE acheter SET quantite = quantite + 1 WHERE id_client = ? AND id_produit = ?;");
        $statementtt->execute(array($id_client, $id_produit));
    }
    else{
        $statement = $db->prepare("INSERT INTO acheter (id_client,id_produit,quantite) VALUES (?,?,?);");
        $statement->execute(array($id_client, $id_produit,1));
    }
    Database::disconnect();
}

//Ajout des produit à une commande
function doAddProduitCommande($date_commande,$statut,$id_client,$prix_total){
    $db = Database::connect();
    $statement = $db->prepare("INSERT INTO commande (date_commande,statut,id_client,prix_total) VALUES (?,?,?,?)");
    $statement->execute(array($date_commande,$statut,$id_client,$prix_total));
    $statementt = $db->prepare("DELETE FROM acheter WHERE id_client = ?");
    $statementt->execute(array($id_client));
    Database::disconnect();
}

//Suppression d'un produit
function doDeleteProduit($id){
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM produit WHERE id_produit = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: ../web_page_admin/admin.php");
}

//Suppression d'un produit du panier
function doDeleteProduitPanier($id_client,$id_produit){
    $db = Database::connect();
    $statementt = $db->prepare("SELECT quantite AS nb FROM acheter WHERE id_client = ? AND id_produit = ?");
    $statementt->execute(array($id_client,$id_produit));
    $results = $statementt->fetch();
    $nb = $results['nb'];
    if($nb == 1){
        $statement = $db->prepare("DELETE FROM acheter WHERE id_client = ? AND id_produit = ?");
        $statement->execute(array($id_client, $id_produit));
    }
    else{
        $statementtt = $db->prepare("UPDATE acheter SET quantite = quantite - 1 WHERE id_client = ? AND id_produit = ?;");
        $statementtt->execute(array($id_client, $id_produit));
    }
    Database::disconnect();
}

//Modification d'un produit
function doUpdateProduit($name,$description,$price,$category,$img,$id,$img_result){
    $db = Database::connect();
    $statementt = $db->prepare("SELECT image FROM produit WHERE id_produit = ?");
    $statementt->execute(array($id));
    $results = $statementt->fetch();
    if($img_result){
        $img = "../images/$img";
    }
    else{
        $img = $results['image'];
    }
    $statement = $db->prepare("UPDATE produit set libelle = ?, description = ?, prix = ?, id_categorie = ?, image = ? WHERE id_produit = ?");
    $statement->execute(array($name,$description,$price,$category,$img,$id));
    Database::disconnect();
}

//Modification des informations du profil
function doUpdateProfile($nom,$prenom,$dateNaiss,$email,$mdp,$id){
    $db = Database::connect();
    $statement = $db->prepare("UPDATE utilisateur set nom = ?, prenom = ?, dateNaiss = ?, email = ?, mdp = ? WHERE id_utilisateur = ?");
    $statement->execute(array($nom,$prenom,$dateNaiss,$email,$mdp,$id));
    Database::disconnect();
}

function returnProductPrice($id_produit){
    $db = Database::connect();
    $statementt = $db->prepare("SELECT prix FROM produit WHERE id_produit = ?");
    $statementt->execute(array($id_produit));
    $results = $statementt->fetch();
    return $results['prix'];
}

function updatePrice($prix,$id){
    $db = Database::connect();
    $statement = $db->prepare("UPDATE produit set prix = ? WHERE id_produit = ?");
    $statement->execute(array($prix,$id));
    Database::disconnect();
}

function countPorduit(){
    $db = Database::connect();
    $statementt = $db->query("SELECT COUNT(*) AS nb FROM produit");
    $results = $statementt->fetch();
    return $results['nb'];
}
?>