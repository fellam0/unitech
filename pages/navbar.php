<?php

// Vérifie si l'utilisateur est connecté
if(isset($_SESSION['utilisateur'])) {
    // Inclusion du fichier de configuration de la base de données
    include("../config/config.php");

    // Requête SQL pour récupérer les informations de l'utilisateur
    $requete_info_utilisateur = "SELECT nom_utilisateur, nom, prenom, email, specialite, niveau, systeme,photo_profil FROM etudiant WHERE id = ?";
    $stmt = $connexion->prepare($requete_info_utilisateur);
    $stmt->bind_param("s", $_SESSION['utilisateur']);
    $stmt->execute();
    $resultat = $stmt->get_result();
    $utilisateur = $resultat->fetch_assoc();

    // Vérifier si l'utilisateur a été trouvé
    if ($utilisateur) {
        // Récupération des données de l'utilisateur
        $nom_utilisateur = $utilisateur['nom_utilisateur'];
        $nom = $utilisateur['nom'];
        $prenom = $utilisateur['prenom'];
        $email = $utilisateur['email'];
        $specialite = $utilisateur['specialite'];
        $niveau = $utilisateur['niveau'];
        $systeme = $utilisateur['systeme'];
        $photo_profil = $utilisateur['photo_profil'];
            // Remplacement des occurrences de "../.." par "../"
            $photo_profil = str_replace("../..", "..", $photo_profil);
        // Utilisez les variables récupérées pour afficher les informations de l'utilisateur où vous en avez besoin dans votre page
    } else {
        // L'utilisateur n'a pas été trouvé
        // Gérer l'erreur ou rediriger l'utilisateur
    }

    // Fermeture de la connexion à la base de données
    $stmt->close();
    $connexion->close();
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <link rel="stylesheet" href="../static/css/navbar.css" />
    <title></title>
  </head>
  <body>
    <nav class="navbar">
      <img style="width:100px;margin-left:-80px;" src="../static/img/accueil/logo.png" class="logo-navbar alt=">
       <h1 class="h1_navbar"style="color:white;">UniForTech</h1>
      <ul class="navbar-list">
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="./livres.php">Bibliotheque</a></li>
        <li><a href="./ressources.php">Ressource</a></li>
        <li><a href="./service.php">Service</a></li>
      </ul>

      <div class="profile-dropdown" >
        <div onclick="toggle()" class="profile-dropdown-btn">
          <div class="profile-img">
            <?php
            // Chemin de l'image par défaut
            $imageParDefaut = "../static/img/photo_profil_par_defaut.png";
            
            // Vérifier si l'utilisateur a une photo de profil
            if (!empty($photo_profil)) {
                echo '<img style="width:50px;" src="' . $photo_profil . '" alt="">';
            } else {
                // Afficher l'image par défaut si l'utilisateur n'a pas de photo de profil
                echo '<img style="width:50px;" src="' . $imageParDefaut . '" alt="">';
            }
            ?>
          </div>

          <span>
            <?php echo $nom_utilisateur; ?>
            <i class="fa-solid fa-angle-down"></i>
          </span>
        </div>

        <ul class="profile-dropdown-list">
          <li class="profile-dropdown-list-item">
            <a href="./profil.php">
              <i class="fa-regular fa-user"></i>
              Profil
            </a>
          </li>
          <hr/>
          <li class="profile-dropdown-list-item">
            <a href="./traitement/deconnexion.php">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
              Se deconnecter
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <script>
        let profileDropdownList = document.querySelector(".profile-dropdown-list");
        let btn = document.querySelector(".profile-dropdown-btn");

        let classList = profileDropdownList.classList;

        const toggle = () => classList.toggle("active");

        window.addEventListener("click", function (e) {
        if (!btn.contains(e.target)) classList.remove("active");
        });
    </script>
  </body>
</html>
