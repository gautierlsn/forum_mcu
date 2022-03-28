<?php

//Création du Head
function makeHead($css,$jquery,$scriptjs){
    echo'
<!DOCTYPE html>
<html lang = "fr">
<head>
    <title>Forum MCU</title >
    <meta charset = "UTF-8" >
    <meta name ="viewport" content = "user-scalable=0, width=device-width, maximum-scale=1.0, initial-scale=1.0">
    <link rel="stylesheet" href="'.$css.'">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/font-awesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src ="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity ="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin ="anonymous"></script>
    <script src="'.$jquery.'"></script>
    <script src="'.$scriptjs.'"></script>
    <script src ="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity ="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin ="anonymous"></script>
</head>
<header id="home">
</header>
';
}

//Formulaire de login
function login_form($msg_error){
echo '
    <body class="bg">
        <main class="login-form h-100">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-12 my-auto">
                        <div id="blur"></div>
                        <div class="card" id="mycardlogin">
                            <div class="card-header">
                                <div class="row flex-nowrap">
                                    <div class="col-md-12">
                                        <h3 class="font40 mt-1 mb-1 registerToggler text-primary" data-toggle="login">Connexion</h3>
                                    </div>
                                </div>
                            </div> 
                            <div class="card-body overflow-hidden">
                                <!-- Formulaire de Login -->
                                <form name="selectForm" id="login" data-type="login-form" action="Script_PHP/do_login.php" method="POST">
                                    <div class="form-group row">
                                        <label for="email_address" class="col-md-4 col-form-label text-md-center text-nowrap">Email <i class="fas fa-user"></i></label>
                                        <div class="col-md-6">
                                            <input type="text" id="email_address" placeholder="Votre email" class="form-control" name="login" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-center text-nowrap">Mot de passe <i class="fas fa-key"></i></label>
                                        <div class="col-md-6">
                                            <input type="password" id="password" placeholder="Votre mot de passe" class="form-control" name="motdepasse" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        <a href="web_page/inscription.php">Pas encore de compte ?</a>
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        <button type="submit" class="btn btn-primary btn-lg mt-2">Valider <i class="fas fa-sign-in-alt" id="turn"></i></button>
                                        <p class="red">'.$msg_error.'</p>
                                    </div>
                                </form>
                                <!-- ./Formulaire de Login -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
';
}

//Formulaire d'inscription
function register_form($msg_error){
    echo '
        <body class="bg">
            <main class="login-form h-100">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-md-12 my-auto">
                            <div id="blur"></div>
                            <div class="card" id="mycardlogin">
                                <div class="card-header">
                                    <div class="row flex-nowrap">
                                        <div class="col-md-12">
                                            <h3 class="font40 mt-1 mb-1 registerToggler text-primary" data-toggle="login">Inscription</h3>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card-body overflow-hidden">
                                    <!-- Formulaire de Login -->
                                    <form name="selectForm" id="login" data-type="login-form" action="../Script_PHP/do_inscription.php" method="POST">
                                        <div class="form-group row">
                                            <label for="nom" class="col-md-4 col-form-label text-md-center text-nowrap">Nom <i class="fas fa-user"></i></label>
                                            <div class="col-md-6">
                                                <input type="text" id="nom" placeholder="Votre nom" class="form-control" name="nom" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="prenom" class="col-md-4 col-form-label text-md-center text-nowrap">Prénom <i class="fas fa-user"></i></label>
                                            <div class="col-md-6">
                                                <input type="text" id="prenom" placeholder="Votre prénom" class="form-control" name="prenom" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dateNaiss" class="col-md-4 col-form-label text-md-center text-nowrap">Date de naissance <i class="fas fa-user"></i></label>
                                            <div class="col-md-6 text-center">
                                                <input type="date" id="dateNaiss" name="dateNaiss" value="2018-07-22" min="2018-01-01" max="2018-12-31">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email_address" class="col-md-4 col-form-label text-md-center text-nowrap">Email <i class="fas fa-user"></i></label>
                                            <div class="col-md-6">
                                                <input type="text" id="email_address" placeholder="Votre email" class="form-control" name="email" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-center text-nowrap">Mot de passe <i class="fas fa-key"></i></label>
                                            <div class="col-md-6">
                                                <input type="password" id="password" placeholder="Votre mot de passe" class="form-control" name="motdepasse" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center mt-3">
                                            <a href="../index.php">Vous possédez déjà un compte ?</a>
                                        </div>
                                        <div class="col-md-12 text-center mt-3">
                                            <button type="submit" class="btn btn-primary btn-lg mt-2">Valider <i class="fas fa-sign-in-alt" id="turn"></i></button>
                                            <p class="red">'.$msg_error.'</p>
                                        </div>
                                    </form>
                                    <!-- ./Formulaire de Login -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </body>
    </html>
    ';
    }

//Création de la navbar
function nav($urlForum,$urlProfil,$urlAdmin,$active){
if ($_SESSION['admin'] != 1){
    $urlAdmin = "";
}
echo '
<body>
    <nav class="topnav">
        <a href="../web_page/forum.php"> <img src="../images/bouclier.png" class="image logo-circle"> </a>
        <label for="btn" class="icon">
            <span class="fa fa-bars"></span>
        </label>
        <input type="checkbox" id="btn">
        <ul class="text-center">
            <li><a class="'.($active == $urlForum ? "active" : "").'" href="'.$urlForum.'">Forum</a></li>
            <li><a class="'.($active == $urlProfil ? "active" : "").'" href="'.$urlProfil.'">Profil</a></li>';
            if(!empty($urlAdmin)) {
                echo'<li><a class="'.($active == $urlAdmin ? "active" : "").'" href="'.$urlAdmin.'">Admin</a ></li>';
            }
             echo'
            <li><a href="../Script_PHP/logout.php">Déconnexion</a></li>
        </ul>
    </nav>
';
}

function areYouSureToDelete($id){
echo'
    <div class="mini_separator_white"></div>
    <div class="container">
        <div class="row">
            <h1 class="mx-auto text-center"><strong>Etes vous sur de vouloir supprimer ?</strong></h1>
        </div>
        <div class="row">
            <form class="form mx-auto mt-3" action="delete.php" role="form" method="post">
                <input type="hidden" name="id" value="'.$id.'"/>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Oui</button>
                    <a class="btn btn-default" href="admin.php">Non</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
';
}

function checkInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
?>

