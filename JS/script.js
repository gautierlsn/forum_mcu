//Si les identifiants sont mauvais les inputs deviennent rouge
$(document).ready(function () {
    if (!$(".error").is(':empty')) {
        $("form[data-type='login-form'] .form-control").css("border-bottom-color", "#f03434");
    }
});

function validateInscription() {
    var nom = document.forms["selectForm"]["nom"].value;
    var prenom = document.forms["selectForm"]["prenom"].value;
    var email = document.forms["selectForm"]["email"].value;
    var motdepasse = document.forms["selectForm"]["motdepasse"].value;
    if (!nom || !prenom || !email || !motdepasse) {
        alert("Merci de remplir tout les champs");
        return false;
    }
}