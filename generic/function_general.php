<?php

//Création du Head
function makeHead($css,$jquery,$scriptjs){
    echo'
<!DOCTYPE html>
<html lang = "fr">
<head>
    <title>Forum MCU</title >
    <meta charset = "UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Forum sur le thème du MCU dans le cadre la formation dispensé par l\'Insitut G4">
    <meta name="keywords" content="forum, mcu, insitutg4, marvel, ironman">
    <link rel="stylesheet" href="'.$css.'">
    <link rel="icon" type="image/x-icon" href="../images/bouclier.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src ="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity ="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin ="anonymous"></script>
    <script src="'.$jquery.'"></script>
    <script src="'.$scriptjs.'"></script>
</head>
';
}

//Création du nav
function nav($urlForum,$urlProfil,$urlAdmin,$active){
if ($_SESSION['role'] != 1){
    $urlAdmin = "";
}
echo '
<body>
    <nav class="topnav">
        <a href="../web_page/forum.php"> <img src="../images/bouclier.png" class="image logo-circle" alt="bouclier"> </a>
        <label for="bouton" class="icon">
            <span class="fa fa-bars"></span>
        </label>
        <input type="checkbox" id="bouton">
        <ul class="text-center">
            <li><a class="'.($active == $urlForum ? "active" : "").'" href="'.$urlForum.'">Forum</a></li>
            <li><a class="'.($active == $urlProfil ? "active" : "").'" href="'.$urlProfil.'">Profil</a></li>';
            if(!empty($urlAdmin)) {
                echo'<li><a class="'.($active == $urlAdmin ? "active" : "").'" href="'.$urlAdmin.'">Admin</a ></li>';
            }
             echo'
            <li><a href="../script/do_logout.php">Déconnexion</a></li>
        </ul>
    </nav>
';
}

function checkInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
?>

