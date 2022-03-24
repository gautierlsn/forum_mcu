<?php
    session_start();
    require("../Script_PHP/function_general.php");
    require("../Script_PHP/function_bdd.php");
    makeHead("../CSS/bootstrap.min.css","../CSS/stylesheet.css","../JS/jquery.js","../JS/script.js");
    nav("../web_page/panier.php","../web_page/profile.php","../web_page/pizza.php","../web_page/boisson.php",
        "../web_page/dessert.php","admin.php","../web_page/commande.php","admin.php");
    verifLogin();
    verifAdmin();
    $nameError = $descriptionError = $priceError = $categoryError = $imageError = "";
    if(!empty($_POST)){
        $name         = checkInput($_POST['name']);
        $description  = checkInput($_POST['description']);
        $price        = checkInput($_POST['price']);
        $category     = checkInput($_POST['category']);
        $image        = checkInput($_FILES["image"]["name"]);
        $imagePath    = '../images/'. basename($image);
        $imageExtension = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess = true;
        $isUploadSuccess = false;

        if(empty($name)){
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($price)){
            $priceError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($category)){
            $categoryError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($image)){
            $imageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        else{
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ){
                $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)){
                $imageError = "Le fichier existe deja";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000){
                $imageError = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                }
            }
        }

        if($isSuccess && $isUploadSuccess){
            //Ajout d'un produit
            doAddProduit($name,$price,$description,$image,$category);
            header("Location: admin.php");
        }
    }
    //Formulaire pour ajouter un produit
    addProduitForm($nameError,$priceError,$categoryError,$imageError);
?>