//Si les identifiants sont mauvais les inputs deviennent rouge
$(document).ready(function () {
    if (!$(".error").is(':empty')) {
        $("form[data-type='login-form'] .form-control").css("border-bottom-color", "#f03434");
    }
});

function validateRegisterForm() {
    var a = document.forms["selectForm"]["nom"].value;
    var b = document.forms["selectForm"]["prenom"].value;
    var c = document.forms["selectForm"]["dateNaiss"].value;
    var d = document.forms["selectForm"]["email"].value;
    var e = document.forms["selectForm"]["password"].value;
    if (!a) {
        alert("Merci de rentrer un nom avant de faire l'inscription");
        return false;
    } else if (!b) {
        alert("Merci de rentrer un prenom avant de faire l'inscription");
        return false;
    } else if (!c) {
        alert("Merci de rentrer une date de naissance");
        return false;
    } else if (!d) {
        alert("Merci de rentrer un l'email");
        return false;
    } else if (!e) {
        alert("Merci de rentrer un mot de passe");
        return false;
    }
}

function ValidateSignForm(inputText) {
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(!inputText.value.match(mailformat))
    {
        alert("Merci de rentrer une adresse mail valide");
        return false;
    }
}
