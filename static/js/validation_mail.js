document.getElementById('email').addEventListener('input', function () {
    var email = this.value;
    var emailError = document.getElementById('email-error');
    
    // Perform validation if email is not empty
    if (email !== '') {
        if (!email.endsWith('@gmail.com')) {
            emailError.style.display = 'block';  // Show error if invalid
        } else {
            emailError.style.display = 'none';   // Hide error if valid
        }
    } else {
        emailError.style.display = 'none';       // Hide error if email field is empty
    }
});
document.getElementById('mot_de_passe').addEventListener('input', function () {
    var password = this.value;
    var passwordError = document.getElementById('password-error');
    
    // Regex to check at least 8 characters and 1 uppercase letter
    var passwordRegex = /^(?=.*[A-Z]).{8,}$/;

    // Perform validation
    if (!passwordRegex.test(password)) {
        passwordError.style.display = 'block';  // Show error if invalid
    } else {
        passwordError.style.display = 'none';   // Hide error if valid
    }
});
document.addEventListener("DOMContentLoaded", function() {
    const passwordField = document.getElementById("mot_de_passe");
    const confirmPasswordField = document.getElementById("confirm_mot_de_passe");
    const confirmPasswordError = document.getElementById("confirm-password-error");

    // Vérifie la correspondance des mots de passe
    confirmPasswordField.addEventListener("input", function() {
        if (passwordField.value !== confirmPasswordField.value) {
            confirmPasswordError.style.display = "block"; // Affiche le message d'erreur
        } else {
            confirmPasswordError.style.display = "none"; // Cache le message d'erreur
        }
    });
});


