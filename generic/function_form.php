<?php

//Formulaire de login
function login_form($msg_error)
{
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
                                            <label for="email_address" class="col-md-4 col-form-label text-center text-nowrap">Email <i class="fas fa-user"></i></label>
                                            <div class="col-md-6">
                                                <input type="text" id="email_address" placeholder="Votre email" class="form-control" name="login" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-center text-nowrap">Mot de passe <i class="fas fa-key"></i></label>
                                            <div class="col-md-6">
                                                <input type="password" id="password" placeholder="Votre mot de passe" class="form-control" name="motdepasse" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center mt-3">
                                            <a href="web_page/inscription.php">Pas encore de compte ?</a>
                                        </div>
                                        <div class="col-md-12 text-center mt-3">
                                            <button type="submit" class="btn btn-perso-blue btn-lg mt-2">Se connecter <i class="fas fa-sign-in-alt" id="turn"></i></button>
                                            <p class="red bold">' . $msg_error . '</p>
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
function register_form($msg_error)
{
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
                                        <script src=".$scriptjs."></script>
                                        <form name="selectForm" id="login" data-type="login-form" action="../script/do_inscription.php" method="POST">
                                            <div class="form-group row">
                                                <label for="nom" class="col-md-4 col-form-label text-center text-nowrap">Nom <i class="fas fa-user"></i></label>
                                                <input type="text" id="nom" placeholder="Votre nom" class="form-control" name="nom" required="required">
                                            </div>
                                            <div class="form-group row">
                                                <label for="prenom" class="col-md-4 col-form-label text-center text-nowrap">Prénom <i class="fas fa-user"></i></label>
                                                <input type="text" id="prenom" placeholder="Votre prénom" class="form-control" name="prenom" required="required">
                                            </div>
                                            <div class="form-group row mx-auto">
                                                <label for="dateNaiss" class="col-md-4 col-form-label text-center text-nowrap">Date de naissance <i class="fas fa-birthday-cake"></i></label>
                                                <div class="col-md-6 text-center">
                                                    <input type="date" id="dateNaiss" name="dateNaiss" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email_address" class="col-md-4 col-form-label text-center text-nowrap">Email <i class="fas fa-at"></i></label>
                                                <input type="text" id="email_address" placeholder="Votre email" class="form-control" name="email" required="required">
                                            </div>
                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-center text-nowrap">Mot de passe <i class="fas fa-key"></i></label>
                                                <input type="password" id="password" placeholder="Votre mot de passe" class="form-control" name="motdepasse" required="required">
                                            </div>
                                            <div class="col-md-12 text-center mt-3">
                                                <a href="../index.php">Vous possédez déjà un compte ?</a>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-perso-blue btn-lg mt-2">S\'incrire <i class="fas fa-user-plus" id="turn"></i></button>
                                                <p class="red bold">' . $msg_error . '</p>
                                            </div>
                                        </form>
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
function createDiscussionForm($id)
{
    echo '
            <div class="separator_white"></div>
            <div class="container">
                <div class="row">
                    <h1 class="text-center mx-auto font50">Créer votre discussion</h1><hr>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <form class="form" action="../script/do_add.php?action=addDiscussion&id=' . $id . '" role="form" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="contenu" class="form-label" >Contenu :</label>
                                <input type="text" class="form-control" id="contenu" name="contenu" required="required">
                            </div>
                            <div class="row">
                                <div class="form-actions mx-auto mt-3">
                                    <a class="btn btn-perso-blue btn-lg" href="forum.php">Retour <i class="fas fa-arrow-alt-circle-left" id="turn"></i></a>
                                    <button type="submit" class="btn btn-perso-green btn-lg">Créer <i class="fas fa-check" id="turn"></i></button>
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
function updateProfileForm($user, $nameError, $prenomError, $adresseError, $loginError, $mdpError)
{
    $mdp = "******";

    echo '
            <div class="separator_white"></div>
            <div class="container">
                <div class="row">
                    <h1 class="text-center mx-auto font50">Modifier votre profil</h1><hr>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <form class="form form-width-reduct" action="update_profile.php" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="nom" class="col-md-4 col-form-label text-center text-nowrap">Nom <i class="fas fa-user"></i></label>
                                <input type="text" class="form-control" id="nom" name="nom" value="' . $user['nom'] . '" required="required">
                            </div>
                            <div class="form-group row">
                                <label for="prenom" class="col-md-4 col-form-label text-center text-nowrap">Prénom <i class="fas fa-user"></i></label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="' . $user['prenom'] . '" required="required">
                            </div>
                            <div class="form-group row">
                                <label for="dateNaiss" class="col-md-4 col-form-label text-center text-nowrap">Date de naissance <i class="fas fa-birthday-cake"></i></label>
                                <div class="col-md-6 text-center">
                                    <input type="date" id="dateNaiss" name="dateNaiss" value="' . $user['dateNaiss'] . '" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-center text-nowrap">Email <i class="fas fa-at"></i></label>
                                <input type="text" class="form-control" id="email" name="email" value="' . $user['email'] . '" required="required">
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-center text-nowrap">Mot de passe <i class="fas fa-key"></i></label>
                                <input type="password" class="form-control" id="password" name="mdp" value="' . $user['mdp'] . '" required="required">
                            </div>
                            <div class="row">
                                <div class="form-actions mx-auto">
                                    <a class="btn btn-perso-blue btn-lg" href="profile.php">Retour <i class="fas fa-arrow-alt-circle-left" id="turn"></i></a>
                                    <button type="submit" class="btn btn-perso-green btn-lg">Modifier <i class="fas fa-user-edit" id="turn"></i></button>
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

