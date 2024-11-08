<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie du code de réinitialisation</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/mdp_oublier.css"> <!-- Assure-toi d'utiliser le bon fichier CSS -->
    <link rel="icon" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
    <div class="background">  
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="container">
        <?php if(isset($_GET['error'])): ?>
            <p class="error" style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <h3>Saisie du code de réinitialisation</h3>

        <form action="./traitement/traitement_saisie_code.php" method="POST">
            <label for="code">Code de réinitialisation :</label>
            <input type="text" id="code" name="code" required>

            <label for="nouveau_mot_de_passe">Nouveau mot de passe :</label>
            <div class="password-container">
                <input type="password" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" required>
                <button type="button" class="toggle-password" id="togglePassword"><i class="fas fa-eye"></i></button>
            </div>

            <button type="submit">Réinitialiser le mot de passe</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.getElementById("togglePassword");
            const passwordField = document.getElementById("nouveau_mot_de_passe");

            togglePassword.addEventListener("click", function() {
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
                this.innerHTML = type === "password" ? "<i class='fas fa-eye'></i>" : "<i class='fas fa-eye-slash'></i>";
            });
        });
    </script>
</body>
</html>
