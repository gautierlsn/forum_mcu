<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");
    makeHead("../CSS/bootstrap.min.css","../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");
    nav("../web_page/panier.php","../web_page/profile.php","../web_page/pizza.php","../web_page/boisson.php",
        "../web_page/dessert.php","admin.php","../web_page/commande.php","admin.php");
    verifLogin();
    verifAdmin();
    $id = checkInput($_GET['id']);
    //Affiche seulement un produit
    showProduit($id);
?>