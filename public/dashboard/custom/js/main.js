$(document).ready(function(){
    $('.delete_all_button').hide();

    let langOptions = {
        language: $('html').attr('lang'),
        pathPrefix: "/dashboard/lang"
    };
    $("[data-localize]").localize('app', langOptions);



        var togglePasswordButtons = document.querySelectorAll(".toggle-password");
    
        togglePasswordButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                var passwordInput = button.parentElement.querySelector(".password-input");
                var eyeIcon = button.querySelector("i");
    
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                } else {
                    passwordInput.type = "password";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                }
            });
    });


});