<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
    <link rel="stylesheet" href="../static/css/login_form.css">
    <link rel="icon" type="image/x-icon" href="../img/">
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="./traitement/traitement_inscription.php"  method="POST">
            <?php
            // Affichage des messages d'erreur
            if(isset($_GET['error'])){
                $error = $_GET['error'];
                echo "<p class='error'>$error</p>";
            }
            ?>
                <h1>Créer un compte</h1>
                <div class="form__group field">
                    <input type="email" class="form__field" placeholder="mail" name="email" id="email" required>
                    <label for="email" class="form__label">mail </label>
                    <p id="email-error" class="error" style="display: none; color: red;">L'email doit se terminer par @etu.cyu.fr</p>
                </div>

                <div class="form__group field">
                    <input type="password" class="form__field" placeholder="mot de passe" name="mot_de_passe" id="mot_de_passe" required>
                    <label for="mot_de_passe" class="form__label">mot de passe:</label>
                    <p id="password-error" class="error" style="display: none; color: red;">Le mot de passe doit contenir au moins 8 caractères et une majuscule.</p>
                </div>
                <!--  champ de confirmation du mot de passe -->
                <div class="form__group field">
                    <input type="password" class="form__field" placeholder="Confirmer le mot de passe" name="confirm_mot_de_passe" id="confirm_mot_de_passe" required>
                    <label for="confirm_mot_de_passe" class="form__label">Confirmer le mot de passe</label>
                    <p id="confirm-password-error" class="error" style="display: none; color: red;">Les mots de passe ne correspondent pas.</p>
                </div>


                <label class="label">Systeme:</label>
                <div class="container-label">
                    <label for="lmd">LMD</label>
                    <input type="radio" name="systeme" id="lmd" value="LMD" onclick="showLevels()" required>
                    <label class="btn-radio" for="ingenieur">Ingenieur</label>
                    <input type="radio" name="systeme" id="ingenieur" value="Ingenieur" onclick="showLevels()" required>
                </div>
                <div id="levels" style="display: none;">
                    <label for="niveau" class="label">Niveau:</label><br>
                    <select name="niveau"class="form__select" id="niveau" onchange="showSpecialties()">
                        <!-- Options will be added dynamically based on selection -->
                    </select>
                </div>
                <div id="specialties" style="display: none;">
                    <label class="label" for="specialite">Specialite:</label><br>
                    <select name="specialite"class="form__select" id="specialite">
                        <!-- Options will be added dynamically based on selection -->
                    </select>
                </div>
                
                <button type="submit"  class="button btn">
                    <span class="button-text">creer</span>
                    <div class="fill-container"></div>
               </button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <!-- Sign-in form content -->
            <form action="traitement/traitement_connexion.php" method="POST">
                 <?php if(isset($_GET['error_mail_mdp'])): ?>
                 <p class="error"><?php echo $_GET['error_mail_mdp']; ?></p>
                <?php endif; ?>
                <?php
                    if(isset($_GET['success'])){
                        $success = $_GET['success'];
                        echo "<p class='success'>$success</p>";
                    }
                    ?>

                <h1>Se connecter</h1>
                <div class="form__group field">
                    <input type="email" class="form__field" placeholder="email" name="email" id="email" required>
                    <label for="email" class="form__label">mail</label>
                </div>
                <div class="form__group field">
                 <input type="password" class="form__field" placeholder="mot de passe" name="mot_de_passe" id="mot_de_passe_login" required>
                 <label for="mot_de_passe_login" class="form__label">Password</label>
                 <button style="color:white; margin-left:20px;" type="button" id="togglePasswordLogin" class="toggle-password"><span id="eyeIcon"><i  class="fas fa-eye"></i></span></button>
              </div>
                <p style="color:white;">si vous avez oublier votre mot de passe <a href="./motdepasse_oublier.php" class="lien">cliquer ici</a></p>
                <button type="submit"  class="button btn">
                    <span class="button-text">connexion</span>
                    <div class="fill-container"></div>
               </button>
            </form>
        </div>
        <div class="overlay-container">
            <!-- Overlay content -->
            <div class="overlay" style="background-color:black;">
                <div class="overlay-panel overlay-left">
                    <h1>Content de te revoir!</h1>
                    <p>Pour ne rien manquer de nos dernières actualités, offres exclusives et nouveautés, connectez-vous dès maintenant avec vos informations personnelles.</p>
                    <button id="signIn"  class="button btn">
                        <span class="button-text">Se connecter</span>
                        <div class="fill-container"></div>
                   </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bonjour cher étudiant!</h1>
                    <p>Entrez vos informations personnelles et commencez votre voyage avec nous</p>
                    <button id="signUp"  class="button btn">
                        <span class="button-text">S'inscrire</span>
                        <div class="fill-container"></div>
                   </button>
                </div>
            </div>
        </div>
    </div>
    <script>
     const signUpButton = document.getElementById('signUp');
     const signInButton = document.getElementById('signIn');
     const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

            function showLevels() {
            var lmdRadio = document.getElementById("lmd");
            var ingenieurRadio = document.getElementById("ingenieur");
            var levelsDiv = document.getElementById("levels");
            var specialtiesDiv = document.getElementById("specialties");

            if (lmdRadio.checked) {
                levelsDiv.style.display = "block";
                specialtiesDiv.style.display = "block";
                populateLevels(["L1", "L2", "L3", "M1", "M2"]);
                showSpecialties(); // Appel de la fonction pour mettre à jour les spécialités
            } else if (ingenieurRadio.checked) {
                levelsDiv.style.display = "block";
                specialtiesDiv.style.display = "none"; // Hide specialties for ingenieur
                populateLevels(["1ère année", "2ème année", "3ème année", "4ème année", "5ème année"]);
            } else {
                levelsDiv.style.display = "none";
                specialtiesDiv.style.display = "none";
            }
        }
                function populateLevels(levels) {
                    var niveauSelect = document.getElementById("niveau");
                    niveauSelect.innerHTML = ""; // Clear previous options

                    levels.forEach(function(level) {
                        var option = document.createElement("option");
                        option.text = level;
                        niveauSelect.add(option);
                    });
                }

                function showSpecialties() {
                    var niveauSelect = document.getElementById("niveau");
                    var specialiteSelect = document.getElementById("specialite");
                    var specialties = {
                        "L1": ["Informatique"],
                        "L2": ["Informatique"],
                        "L3": ["Systèmes Informatiques"],
                        "M1": ["Conduite de Projets Informatiques","Systèmes Informatiques","Ingénierie des Systèmes d’information","Réseaux, Mobilité et Systèmes Embarqués","Systèmes Informatiques Intelligents"],
                        "M2": ["Conduite de Projets Informatiques","Systèmes Informatiques","Ingénierie des Systèmes d’information"," Réseaux, Mobilité et Systèmes Embarqués","Systèmes Informatiques Intelligents"]
                    };

                    var selectedNiveau = niveauSelect.value;
                    specialiteSelect.innerHTML = ""; // Clear previous options

                    specialties[selectedNiveau].forEach(function(specialite) {
                        var option = document.createElement("option");
                        option.text = specialite;
                        specialiteSelect.add(option);
                    });
                }
                document.addEventListener('DOMContentLoaded', function() {
                    <?php if (isset($_GET['error'])) { ?>
                        document.querySelector('.container').classList.add('right-panel-active');
                    <?php } ?>
                });
                document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.getElementById("togglePassword");
            const passwordField = document.getElementById("mot_de_passe");
            let passwordVisible = false; // Ajoutez une variable pour suivre l'état du mot de passe

            togglePassword.addEventListener("click", function() {
                passwordVisible = !passwordVisible; // Inversez l'état du mot de passe
                const type = passwordVisible ? "text" : "password"; // Utilisez l'état pour déterminer le type
                passwordField.setAttribute("type", type);
                this.innerHTML = passwordVisible ? "<i class='fas fa-eye-slash'></i>" : "<i class='fas fa-eye'></i>";
            });

            const togglePasswordLogin = document.getElementById("togglePasswordLogin");
            const passwordFieldLogin = document.getElementById("mot_de_passe_login");

            togglePasswordLogin.addEventListener("click", function() {
                passwordVisible = !passwordVisible; // Inversez l'état du mot de passe
                const type = passwordVisible ? "text" : "password"; // Utilisez l'état pour déterminer le type
                passwordFieldLogin.setAttribute("type", type);
                this.innerHTML = passwordVisible ? "<i class='fas fa-eye-slash'></i>" : "<i class='fas fa-eye'></i>";
            });
        });
  </script>
  <script src="../static/js/validation_mail.js"></script>
</body>
</html>
