<?php

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
                                    <form name="selectForm" id="login" data-type="login-form" action="script/do_login.php" method="POST">
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
                                            <p class="red bold">'.$msg_error.'</p>
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
                <main class="register-form h-100">
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
                                        <form name="selectForm" id="login" data-type="login-form" action="../script/do_inscription.php" method="POST">
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
                                                <p class="red bold">'.$msg_error.'</p>
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
                        <form class="form" action="../script/do_add.php?action=addDiscussion&id='.$id.'" role="form" method="post" enctype="multipart/form-data">
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

    //Formulaire pour modifier les informations du profil
    function updateProfileForm($user,$nameError,$prenomError,$adresseError,$loginError,$mdpError){
        $mdp = "******";

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
                                <input type="text" class="form-control" id="nom" name="nom" value="'.$user['nom'].'">
                                <span class="help-inline">'.$nameError.'</span>
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom :</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="'.$user['prenom'].'">
                                <span class="help-inline">'.$prenomError.'</span>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">Email :</label>
                                <input type="text" class="form-control" id="adresse" name="dateNaiss" value="'.$user['dateNaiss'].'">
                                <span class="help-inline">'.$adresseError.'</span>
                            </div>
                            <div class="mb-3">
                                <label for="login" class="form-label">Login :</label>
                                <input type="text" class="form-control" id="login" name="email" value="'.$user['email'].'">
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
?>

