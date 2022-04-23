//Si les identifiants sont mauvais les inputs deviennent rouge
$(document).ready(function () {
    if (!$(".error").is(':empty')) {
        $("form[data-type='login-form'] .form-control").css("border-bottom-color", "#f03434");
    }
});