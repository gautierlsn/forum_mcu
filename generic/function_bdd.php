<?php

require 'database.php';

//Renvoie true ou false si un nombre
function est_multiple($nombre, $multiple){
    if($nombre % $multiple == 0)
        return true;
    else
        return false;
}

/*------------------------------------------------------------------------------------------------------------*/
//Partie utilisateur

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
function checkEmail($email){
    $db = Database::connect();
    $statement = $db->prepare("SELECT count(*) as nb FROM utilisateur WHERE email=?");
    $statement->execute(array($email));
    $results = $statement->fetch();
    Database::disconnect();
    return $results['nb'];
}

//Inscription de l'utilisateur
function inscription($nom, $prenom, $dateNaiss, $email, $motdepasse){
    if(checkEmail($email) == 1){
        return false;
    }
    else{
        $db = Database::connect();
        $statementt = $db->prepare("INSERT INTO utilisateur (nom,prenom,dateNaiss,email,mdp,role) values(?, ?, ?, ?, ?, ?)");
        $statementt->execute(array($nom, $prenom, $dateNaiss, $email, $motdepasse, 0));
        Database::disconnect();
        return true;
    }
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

//Suppression d'un utilisateur
function doDeleteUtilisateur($id){
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM utilisateur WHERE id_utilisateur = ?");
    $statement->execute(array($id));
    Database::disconnect();
}

//Modification des informations du profil
function doUpdateProfile($nom,$prenom,$dateNaiss,$email,$mdp,$id){
    $db = Database::connect();
    $statement = $db->prepare("UPDATE utilisateur set nom = ?, prenom = ?, dateNaiss = ?, email = ?, mdp = ? WHERE id_utilisateur = ?");
    $statement->execute(array($nom,$prenom,$dateNaiss,$email,$mdp,$id));
    Database::disconnect();
}

//Modification des informations du profil
function getUserInfo(){
    $db = Database::connect();
    $statement = $db->prepare("SELECT nom, prenom, dateNaiss, email FROM utilisateur where id_utilisateur = ?");
    $statement->execute(array($_SESSION['id']));
    $item = $statement->fetch();
    Database::disconnect();
    return $item;
}

/*------------------------------------------------------------------------------------------------------------*/
//Partie discussion

//Récupérer toutes les discussions
function getAllTopics(){
    $db = Database::connect();
    $request_get_topics = $db->query(
        'SELECT id_discussion, titre, date_creation, D.id_utilisateur, U.nom, U.prenom
        FROM discussion D, utilisateur U
        WHERE D.id_utilisateur = U.id_utilisateur
        ');
    $all = $request_get_topics->fetchAll();
    Database::disconnect();
    return $all;
}

//Récupérer une discussion
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

//Suppression d'une discussion
function doDeleteDiscussion($id){
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM message WHERE id_discussion = ?");
    $statement->execute(array($id));

    $statementt = $db->prepare("DELETE FROM discussion WHERE id_discussion = ?");
    $statementt->execute(array($id));
    Database::disconnect();
}

//Ajout d'une discussion
function doAddDiscussion($contenu,$id){
    $db = Database::connect();
    $date_creation = date("Y-m-d");
    $statement = $db->prepare("INSERT INTO discussion (titre,date_creation,id_utilisateur) values(?, ?, ?)");
    $statement->execute(array($contenu,$date_creation,$id));
    Database::disconnect();
}


/*------------------------------------------------------------------------------------------------------------*/
//Partie commentaire

//Récupérer tous les commentaires d'une discussion
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
    Database::disconnect();
    return $all;
}

//Ajouter un commentaire à une discussion
function doAddComment($id_discussion,$contenu,$date_creation_message,$id_utilisateur){
    $db = Database::connect();
    $statement = $db->prepare("INSERT INTO message (contenu,date_creation_message,id_discussion,id_utilisateur) values(?, ?, ?, ?)");
    $statement->execute(array($contenu,$date_creation_message,$id_discussion,$id_utilisateur));
    Database::disconnect();
}

//Suppression d'un message
function doDeleteMessage($id){
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM message WHERE id_message = ?");
    $statement->execute(array($id));
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
        <table class="table table-bordered">
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
        echo '<a class="btn btn-danger" href="../Script_PHP/do_delete_user.php?id='.$item['id_utilisateur'].'">  Supprimer <br/> <i class="fas fa-trash"></i></a>';
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





?>