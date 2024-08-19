document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('registerForm');
    var passwordField = document.getElementById('password');
    var confirmPasswordField = document.getElementById('confirm_password');
    var passwordError = document.getElementById('passwordError');

    form.addEventListener('submit', function(event) {
        var password = passwordField.value;
        var confirmPassword = confirmPasswordField.value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Evita que el formulario se envíe
            passwordError.style.display = 'block'; // Muestra el mensaje de error
        } else {
            passwordError.style.display = 'none'; // Oculta el mensaje de error
        }
    });
});
