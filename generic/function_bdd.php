<?php
    require 'database.php';

/*------------------------------------------------------------------------------------------------------------*/
//Partie utilisateur

    //Connexion de l'utilisateur
    function connexion($email,$mdp){
        if(checkEmail($email) == 1){
            $db = Database::connect();
            $statement = $db->prepare("SELECT mdp FROM utilisateur WHERE email=?");
            $statement->execute(array($email));
            $results = $statement->fetch();
            $hashed_password = $results['mdp'];
            Database::disconnect();
            if(password_verify($mdp, $hashed_password)) {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    //Vérification du mail de l'utilisateur
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
            $hashed_password = password_hash($motdepasse, PASSWORD_DEFAULT); //Hash password
            $statementt = $db->prepare("INSERT INTO utilisateur (nom,prenom,dateNaiss,email,mdp,role) values(?, ?, ?, ?, ?, ?)");
            $statementt->execute(array($nom, $prenom, $dateNaiss, $email, $hashed_password, 0));
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
        $_SESSION['dateNaiss'] = $results['dateNaiss'];
        $_SESSION['ROLE'] = $results['role'];
        Database::disconnect();
    }

    //Vérification si l'utilisateur est bel et bien connecté
    function verifLogin(){
        if (!isset($_SESSION['login'])){
            header("Location: ../index.php");
        }
    }

    //Vérification si l'utilisateur est bel et bien connecté en tant qu'admin
    function verifAdmin(){
        if (!$_SESSION['admin'] == 1){
            header("Location: ../Script_PHP/logout.php");
        }
    }

    //Suppression d'un utilisateur
    function doDeleteUser($id){
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM utilisateur WHERE id_utilisateur = ?");
        $statement->execute(array($id));
        Database::disconnect();
    }

    //Modification des informations du profil
    function doUpdateProfile($nom,$prenom,$dateNaiss,$email,$mdp,$id){
        $db = Database::connect();
        $hashed_password = password_hash($mdp, PASSWORD_DEFAULT); //Hash password
        $statement = $db->prepare("UPDATE utilisateur set nom = ?, prenom = ?, dateNaiss = ?, email = ?, mdp = ? WHERE id_utilisateur = ?");
        $statement->execute(array($nom,$prenom,$dateNaiss,$email,$hashed_password,$id));
        Database::disconnect();
    }

    //Récupération du profil de l'utilisateur
    function getUserInfo(){
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM utilisateur where id_utilisateur = ?");
        $statement->execute(array($_SESSION['id']));
        $item = $statement->fetch();
        Database::disconnect();
        return $item;
    }

    //Récupération de la liste de tous les utilisateurs
    function getUsers(){
        $db = Database::connect();
        $statement = $db->prepare('SELECT * FROM utilisateur');
        $statement->execute();
        $item = $statement->fetchAll();
        Database::disconnect();
        return $item;
    }

/*------------------------------------------------------------------------------------------------------------*/
//Partie discussion

    //Récupérer toutes les discussions
    function getAllDiscussion(){
        $db = Database::connect();
        $request_get_topics = $db->query(
            'SELECT *
            FROM discussion D, utilisateur U
            WHERE D.id_utilisateur = U.id_utilisateur
            ');
        $all = $request_get_topics->fetchAll();
        Database::disconnect();
        return $all;
    }

    //Récupérer une discussion
    function getOneDiscussion($idDiscussion){
        $db = Database::connect();
        $statement = $db->prepare(
            'SELECT *
            FROM discussion D, utilisateur U
            WHERE D.id_utilisateur = U.id_utilisateur
            AND id_discussion = ?;
            ');

        $statement->execute(array($idDiscussion));
        $results = $statement->fetch();
        Database::disconnect();
        return $results;
    }

    //Suppression d'une discussion
    function doDeleteDiscussion($id){
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM comment WHERE id_discussion = ?");
        $statement->execute(array($id));
        $statementt = $db->prepare("DELETE FROM discussion WHERE id_discussion = ?");
        $statementt->execute(array($id));
        Database::disconnect();
    }

    //Ajout d'une discussion
    function doAddDiscussion($contenu,$id){
        $db = Database::connect();
        date_default_timezone_set('Europe/Paris');
        $datetime_en = date('Y-m-d H:i');
        $datetime_fr = date("d/m/Y H:i", strtotime($datetime_en));
        $datetime_fr = str_replace(":","h",$datetime_fr);
        $statement = $db->prepare("INSERT INTO discussion (titre,id_utilisateur,date_creation,date_creation_fr) values(?, ?, ?, ?)");
        $statement->execute(array($contenu,$id,$datetime_en,$datetime_fr));
        Database::disconnect();
    }

/*------------------------------------------------------------------------------------------------------------*/
//Partie commentaire

    //Récupérer tous les commentaires d'une discussion
    function getAllCommentsByDiscussion($idDiscussion){
        $db = Database::connect();
        $request_get_comments = $db->prepare(
            'SELECT *
            FROM comment M, utilisateur U
            WHERE M.id_utilisateur = U.id_utilisateur
            AND id_discussion = ? 
            ORDER BY date_creation_comment DESC');
        $request_get_comments->execute(array($idDiscussion));
        $all = $request_get_comments->fetchAll();
        Database::disconnect();
        return $all;
    }

    //Ajouter un commentaire à une discussion
    function doAddComment($id_discussion,$contenu,$id_utilisateur){
        $db = Database::connect();
        date_default_timezone_set('Europe/Paris');
        $datetime_en = date('Y-m-d H:i');
        $datetime_fr = date("d/m/Y H:i", strtotime($datetime_en));
        $datetime_fr = str_replace(":","h",$datetime_fr);
        $statement = $db->prepare("INSERT INTO comment (contenu,date_creation_comment,date_creation_comment_fr,id_discussion,id_utilisateur) values(?,?,?,?,?)");
        $statement->execute(array($contenu,$datetime_en,$datetime_fr,$id_discussion,$id_utilisateur));
        Database::disconnect();
    }

    //Suppression d'un commentaire
    function doDeleteComment($id){
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM comment WHERE id_comment = ?");
        $statement->execute(array($id));
        Database::disconnect();
    }
?>