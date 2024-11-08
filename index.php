<?php
    session_start();
    $is_connected = isset($_SESSION['utilisateur']);
?>


<?php

// Vérifie si l'utilisateur est connecté
if(isset($_SESSION['utilisateur'])) {
    // Inclusion du fichier de configuration de la base de données
    include("./config/config.php");

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
            $photo_profil = str_replace("../..", "./", $photo_profil);
        // Utilisez les variables récupérées pour afficher les informations de l'utilisateur où vous en avez besoin dans votre page
    } else {
        // L'utilisateur n'a pas été trouvé
        // Gérer l'erreur ou rediriger l'utilisateur
    }

    // Fermeture de la connexion à la base de données
    $stmt->close();
    $connexion->close();
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./static/js/index.js"></script>
    <title>Accueil</title>
    <link rel="icon" style="" type="image/x-icon" href="./static/img/arbre-de-la-vie.png">
    <link rel="stylesheet" href="/static/css/cookies.css">
</head>

<body>
<script src="/static/js/cookies.js"></script> <!-- Inclusion du fichier JS -->
 <!-- Bannière de cookies -->
 <div id="cookieConsent" style="display: none;">
    <div class="cookie-message">
        <p>Nous utilisons des cookies pour garantir la meilleure expérience sur notre site.</p>
        <button id="acceptCookies">Accepter</button>
        <button id="rejectCookies">Refuser</button>
    </div>
 </div>

    <?php
        // Inclure la navbar si l'utilisateur est connecté
        if ($is_connected) {
            echo'<link rel="stylesheet" href="./static/css/navbar.css">';
            echo'<nav class="navbar">
            <img style="width:100px;margin-left:-70px;" src="./static/img/accueil/logo.png" class="logo-navbar" alt="">
            <h1 class="h1_navbar"style="color:white;">UniForTech</h1>
            <ul class="navbar-list">
              <li><a href="./index.php">Accueil</a></li>
              <li><a href="./pages/livres.php">Bibliotheque</a></li>
              <li><a href="./pages/ressources.php">Ressource</a></li>
              <li><a href="./pages/service.php">Service</a></li>
            </ul>
           
            <div class="profile-dropdown" >
              <div onclick="toggle()" class="profile-dropdown-btn">
                <div class="profile-img">'?>
                  <?php
                  // Chemin de l\'image par défaut
                  $imageParDefaut = "./static/img/photo_profil_par_defaut.png";
                  
                  // Vérifier si l\'utilisateur a une photo de profil
                  if (!empty($photo_profil)) {
                      echo '<img style="width:50px;" src="' . $photo_profil . '" alt="">';
                  } else {
                      // Afficher l\'image par défaut si l \'utilisateur n\'a pas de photo de profil
                      echo '<img style="width:50px;" src="' . $imageParDefaut . '" alt="">';
                  }
                  ?>
                <?php echo '</div>
      
                <span>';?>
                  <?php echo $nom_utilisateur; ?>
                  <?php echo '<i class="fa-solid fa-angle-down"></i>';?>
                <?php echo '
                </span>
              </div>
      
              <ul class="profile-dropdown-list">
                <li class="profile-dropdown-list-item">
                  <a href="./pages/profil.php">
                    <i class="fa-regular fa-user"></i>
                     Profil
                  </a>
                </li>
                <hr/>
                <li class="profile-dropdown-list-item">
                  <a href="./pages/traitement/deconnexion.php">
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
      </script>'
          ;?>
            <?php echo'<link rel="stylesheet" href="./static/css/index_co.css">';
            
            echo '<header class="header_accueil_co">
                        <div class="header-text">
                            <div class="div-bvn">
                            <h1 class="bienvenu-slogo">Bienvenue sur<br> UniForTech !</h1>
                            </div> 
                        </div>
                   </header>';

echo '<section class="txt-apresheader">
         <h1 class="txt-1">Ensemble, unis pour la technologie! </h1>
        <div class="texte1">
            <div class="vertical-line"></div>
            <p class="txt">Ensemble, unis pour la technologie!
                Découvrez un avenir qui vous appartient avec UNIFORTECH Nous sommes fiers
                de vous offrir tout ce dont vous avez
                besoin. UniForTech est là pour vous, dédié à votre succès. Découvrez comment nous faisons la différence.
            </p>
        </div>
        <div class="img-uni">
            <img class="imgg-uni zoom" src="./static/img/accueil/uni-for-technologie.jpg" alt="">
        </div>
    </section>';

echo '<section class="ressources">
<h1 class="titre-ressources txt-1">UniForTech: Votre Source de Ressources Académiques</h1>

<div class="img-description">
    <div class="3-premiere">
        <div class="container img1">
            <img src="./static/img/accueil/img-1 (7).png" alt="" class="image image-div1">
            <div class="overlay im6 ">
                <div class="text-sourcestitrearrow">
                    <h1 class="resstitre">Cours </h1>
                     <a href="./pages/ressources.php" class="lien_fleche">
                       <div class="arrow-1"></div>
                     </a>
                </div>
            </div>
        </div>
        <div class="container img2">
            <img src="./static/img/accueil/tp1.jpg"  alt="" class="image  image-div2">
            <div class="overlay im1">
                <div class="text-sourcestitrearrow">
                    <h1 class="resstitre1">Séries de Travaux <br> Pratiques (TP)</h1>
                    <a href="./pages/ressources.php" class="lien_fleche">
                       <div class="arrow-1"></div>
                    </a>
                </div>
            </div>
        </div>

        <div class="container img3">
            <img src="./static/img/accueil/serie_td.png" alt="" class="image image-div3">
            <div class="overlay im2">
                <div class="text-sourcestitrearrow">
                    <h1 class="resstitre2">Séries de Travaux <br> Dirigés (TD)</h1>
                    <a href="./pages/ressources.php" class="lien_fleche">
                       <div class="arrow-1"></div>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="3-derniere">
        <div class="container img4">
            <img src="./static/img/accueil/examen.jpg" alt="" class="image image-div4">
            <div class="overlay im3">
                <div class="text-sourcestitrearrow">
                    <h1 class="resstitre3">Sujets d\'Examen</h1>
                    <a href="./pages/ressources.php" class="lien_fleche">
                       <div class="arrow-1 a23"></div>
                   </a>
                </div>
            </div>
        </div>

        <div class="container img5">
            <img src="./static/img/accueil/resume_.jpg" alt="" class="image image-div5">
            <div class="overlay im4">
                <div class="text-sourcestitrearrow">
                    <h1 class="resstitre4">Résumés d\'Étudiants </h1>
                    <a href="./pages/ressources.php" class="lien_fleche">
                       <div class="arrow-1 a33"></div>
                   </a>
                </div>
            </div>
        </div>

        <div class="container img6">
            <img src="./static/img/accueil/img-3.png" alt="" class="image image-div6">
            <div class="overlay im5">
                <div class="text-sourcestitrearrow">
                    <h1 class="resstitre5">Mémoires des Années <br> Passées</h1>
                    <a href="./pages/ressources.php" class="lien_fleche">
                       <div class="arrow-1"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</section>';
echo' <section class="biblio">
<h1 class="tire-biblio txt-1">
    Vos cours en ligne
</h1>
<div class="txt-img-biblio">
    <div class="txt-biblio">
        <p class="txtt-bib">Découvrez notre <a href="./pages/livres.php" style="color:#9f1016;"> Vos Cours</a>, un vaste répertoire de
            coures couvrant diverses
            spécialités. Que vous recherchiez des manuels ou des lectures
            complémentaires,
            notre collection est conçue pour répondre à tous vos besoins académiques et professionnels. Explorez
            notre
            sélection et trouvez les ressources qui vous aideront à exceller dans vos études et votre carrière.
        </p>
    </div>
    <div class="img-biblio">
        <img src="./static/img/accueil/biblio.jpg" alt="" class="imgg-biblio">
    </div>
</div>
</section>';            


echo '<section class="service">
        <div class="servuce-div1">
            <div class="div11-intro">
                <h1 class="service-titre txt-1">
                    UniForTech: Votre Portail de Services Essentiels</h1>
                <p class="txt-service">Chez UniForTech, nous mettons à votre disposition une gamme complète de services
                    essentiels pour enrichir votre expérience académique.
                    Explorez nos services pour rester informé et tirer le meilleur parti de votre parcours
                    universitaire.</p>
            </div>
            <div class=" div11-intro div12-evenement">
                <div class="img-event">
                    <img class="zoom" src="./static/img/accueil/gdsc.jpg" style="height:150px;" alt="">
                </div>
                <div class="txt-event">
                    <h2 class="titreevent">Événements</h2>
                    <p class="txtevent">Participez à des événements exclusifs organisés par UniForTech pour enrichir
                        votre expérience académique. Des ateliers aux conférences, en passant par des compétitions et
                        des séminaires, restez informé des dernières opportunités pour développer vos compétences et
                        élargir votre réseau.</p>
                </div>
            </div>

        </div>
        <div class=" servuce-div1 D2">
            <div class="div11-intro div12-evenement infou">
                <div class="img-univ">
                    <img class="zoom" src="./static/img/accueil/site-saint-martin.jpg" alt="">
                </div>
                <div class="txt-univ">
                    <h2 class="titreuniv">Presentation de l\'Université</h2>
                    <p class="txteunivt">L\'université CY Cergy Paris, est une université française située 
                    a pontoise,  d\'expression </p>
                </div>
            </div>


            <div class=" div12-evenement div21-annoces">
                <div class="img-annonces">
                    <img class="zoom imgsoon" src="./static/img/accueil/annonce.avif""alt="">
                </div>
                <div class="txt-annoces">
                    <h2 class="titreannoces">À venir</h2>
                    <p class="txteannonce">Restez à \'affût des prochaines annonces 
                    ! De nouveaux ateliers, conférences et
                     événements passionnants arrivent bientôt. Ne manquez aucune opportunité de vous impliquer et d\'enrichir votre expérience universitaire 
                    </p>
                </div>
            </div>
        </div>
        <div class="servuce-div1 D3">
            <div class="div12-evenement div31-enmploi-univ">
                <div class="img-emploi">
                    <img class="zoom" src="./static/img/accueil/audience-raising-hand-up-listening-speaker-who-standing-front-room_45990-8.jpg" alt="">
                </div>
                <div class="txt-emploi">
                    <h2 class="titreemploi">rejoignez nos conferences</h2>
                    <p class="txteemploit">Participez aux conférences de notre université et découvrez un monde de savoirs partagés, 
                      d\'innovations de pointe et de discussions inspirantes.C\'est une occasion unique de rencontrer des experts, d \'échanger des idées et d\'enrichir votre réseau professionnel
                    </p>
                </div>
            </div>


            <div class=" div12-evenement div32info-enseignant">
                <div class="img-enseignant">
                    <img class="zoom" src="./static/img/accueil/colleagues-using-laptops-notebooks-learning-study-session_23-2149285424.jpg" alt="join-club">
                </div>
                <div class="txt-enseigant">
                    <h2 class="titreenseigant">Rejoignez les clubs</h2>
                    <p class="txteenseignant">Rejoignez les clubs informatiques de notre université, comme le Google Developer Student Club (GDSC), et plongez dans
                     un monde d\'innovation technologique, de projets collaboratifs et d \'opportunités de mentorat avec des experts de l\'industrie.
                     </p>
                </div>
            </div>


        </div>
        <div class=" div12-evenement  newev">
            <div class="img-enseignant">
                <img class="zoom " src="./static/img/accueil/new-2.jpg" alt="">
            </div>
            <div class="txt-enseigant">
                <h2 class="titreenseigant">Informations sur l\'Université</h2>
                <p class="txteenseignant">Chez UniForTech, nous mettons à votre disposition une gamme complète de
                    services
                    essentiels pour enrichir votre expérience académique.
                    Explorez nos services pour rester informé et tirer le meilleur parti de votre parcours
                    universitaire.</p>
            </div>
        </div>

    </section>';

// Et ainsi de suite pour les autres sections et le footer...
echo'<section class="contactez-nous">
<div class="txt">
    <h2 class="rejoignez-nous-titre">Contactez-nous</h2>
    <p class="inscrp">
    Si vous rencontrez des problèmes ou avez des questions, n\'hésitez pas à nous contacter. Notre équipe est là pour vous aider et s\'assurer que vous bénéficiez de la meilleure expérience possible sur UniForTech.
    </p>
    <button onclick="window.location.href = \'./pages/contact.php\'"  class="button btn-cntn">
        <span class="button-text">Contactez</span>
        <div class="fill-container"></div>
    </button>
</div>
<div class="img-contact imagecontactt"><img src="./static/img/accueil/contact.jpg"></div>
</section>';

include('./pages/footer_index.php');
echo '<script src="./static/index_co.js"></script>';
         } else {
    ?>        
        <header class="header">

            <div class="header-part1">
                <div class="logo-txt">
                    <img src="./static/img/accueil/logo.png" alt="" class="logo">
                </div>
                <div class="txt-log">
                    <h1 class="unifortech-txt" style="margin-top:-8px;margin-left:5px;font-size: 1em;">UniForTech</h1>
                </div>
                <button onclick="window.location.href = './pages/login_form.php'" class="button btn-header">
                    <span class="button-text">Inscription</span>
                    <div class="fill-container"></div>
                </button>
            </div>
            <div class="header1">
              <div class="slogon">
                 <p class="txt-slogon"> Ensemble, apprenons et grandissons dans l'union du savoir.</p>
              </div>
            </div>
         <div class="vide-header"></div>
        </header>
        <div class="scroll-down">
            <p class="scromm-txt">Faites défiler vers le bas pour plus d'informations</p>

          <div class="mousey">
              <div class="scroller"></div>
           </div>
       </div>

        <section class="uni-description">
            <div class="txt-description">
                <p class="txt-des">UniForTech, site dédié aux étudiants en informatique de l'Université de CY Cergy Paris, offre cours, résumés, travaux dirigés et pratiques, ainsi qu'une bibliothèque virtuelle riche en
                    ressources spécialisées. Son engagement à rendre l'éducation informatique accessible à tous, de la licence à
                    l'ingénieur, en fait un partenaire idéal pour réaliser ses ambitions académiques et professionnelles.
                </p>
            </div>
            <!-- Photo Grid -->
            <div class="row">
                <div class="column">
                    <img src="./static/img/accueil/img-1 (7).png" style="width:100%">
                    <img src="./static/img/accueil/img-2222.png" style="width:100%">


                </div>
                <div class="column">
                    <img src="./static/img/accueil/img-5.png" style="width:100%">
                    <img src="./static/img/accueil/biblio2.jpg" style="width:100%">


                </div>
                <div class="column">
                    <img src="./static/img/accueil/background.jpeg" style="width:100%">
                    <img src="./static/img/accueil/bibli_women.jpg" style="width:100%">
                    <img src="./static/img/accueil/groupe_etudiants.jpg" style="width:100%;">

                </div>
                <div class="column">
                    <img src="./static/img/accueil/img-41.png" style="width:100%">
                    <img src="./static/img/accueil/friends-participating-study-session-library_23-2149285392.jpg" style="width:100%">

                </div>
            </div>
       </section>



        <section class="be-apart">
            <p class="txt-be-apart">En tant que membre de UniForTech, vous développerez des compétences professionnelles,
            créatives et techniques grâce à une expérience concrète et pertinente dans le domaine de l'informatique.
            </p>

            <div class="div-beapart1">
               <div class="titre-be-apart">
                    <h1 class="titre-be">Explorez, Apprenez, Réussissez</h1>
                    <p class="txt-be">Cultivez votre excellence avec UniForTech.</p>
                </div>
            </div>
            <div class="img-description">
                <div class="3-premiere">
                    <div class=" containerr img1">
                        <img src="./static/img/accueil/img-1 (7).png" alt="unifortech" class=" imagee image-div1">
                        <div class="overlayy"onclick="window.location.href='./pages/login_form.php'">
                            <div class="text">Uni For tech</div>
                        </div>
                    </div>
                    <div class=" container img2"onclick="window.location.href='./pages/login_form.php'">
                        <img src="./static/img/accueil/img-2.png" alt="ressources" class=" image image-div2">
                        <div class="overlay">
                            <div class="text txt-resource">Ressources</div>
                        </div>
                    </div>
                    <div class=" container img3"onclick="window.location.href='./pages/login_form.php'">
                     <img src="./static/img/accueil/service.jpg" style="height:253px;"alt="service" class=" image image-div3">
                        <div class="overlay">
                            <div class="text txt-sercice">Services divers</div>
                        </div>
                    </div>

                    <div class=" container img4"onclick="window.location.href='./pages/login_form.php'">
                    <img src="./static/img/accueil/low-angle-cheerful-team-students-passed-test-by-preparing-all-together_496169-2336.jpg" style="height:253px;"alt="bibliotheque" class=" image image-div4">
                    <div class="overlay">
                        <div class="text txt-biblio">Bibliothèque</div>
                    </div>
                    </div>

                    <div class=" container img4"onclick="window.location.href='./pages/login_form.php'">
                        <img  style="height:253px;" src="./static/img/accueil/event.jpg" alt="evenement" class=" image image-div4">
                        <div class="overlay">
                            <div class="text txt-events">Evenements</div>
                        </div>
                    </div>
                </div>
            </div>

        </section>


        <section class="pourquoi-uni">
          <h1 class="why-titre">Pourquoi UniForTech</h1>

            <div class="img-xhy-uni">
                <img class="img-wh" src="./static/img/accueil/low-angle-cheerful-team_students_passed-test-by-preparing-all-together_496169-2336.jpg" alt="">
            </div>
           <div class="container-whu-uni">
             <a class="card1" href="./pages/login_form.php">
                    <h3>Assistance spécialisée</h3>
                    <p class="small">Plateforme dédiée exclusivement aux étudiants en informatique de CY Cergy Paris.</p>
                    <div class="go-corner" href="#">
                        <div class="go-arrow">
                            →
                        </div>
                    </div>
               </a>
                <a class="card1" href="./pages/login_form.php">
                    <h3>Répond à vos besoins</h3>
                    <p class="small">Offre des ressources pédagogiques, des cours, des mémoires et d'autres outils pour faciliter
                    vos
                    études.</p>
                    <div class="go-corner" href="#">
                        <div class="go-arrow">
                            →
                        </div>
                    </div>
                </a>
                <a class="card1" href="./pages/login_form.php">
                    <h3>Communication simplifiée</h3>
                    <p class="small">Un espace pour interagir avec vos pairs, obtenir des informations sur les professeurs et
                    accéder à des
                    discussions pertinentes.</p>
                    <div class="go-corner" href="#">
                        <div class="go-arrow">
                            →
                        </div>
                    </div>

                </a>
                <a class="card1" href="./pages/login_form.php">
                    <h3>Engagement envers votre réussite</h3>
                    <p class="small p-text">Notre objectif est de vous soutenir dans votre parcours académique et de vous offrir
                    les outils
                    nécessaires pour exceller.</p>
                    <div class="go-corner" href="#">
                        <div class="go-arrow">
                            →
                        </div>
                    </div>
                </a>
            </div>
        </section>


        <section class="contactez-nous">
            <div class="txt">
                <h2 class="rejoignez-nous-titre">Rejoignez-nous</h2>
                <p class="inscrp">
                    Inscrivez-vous dès maintenant à UniForTech et bénéficiez de tous ses avantages.
                </p>
                <button onclick="window.location.href = './pages/login_form.php'"  class="button btn-cntn">
                    <span class="button-text">Inscription</span>
                    <div class="fill-container"></div>
                </button>
            </div>
          <div class="img-contact"><img src="./static/img/accueil/new3copie.jpg"></div>
        </section>


        <section class="admins">
            <h1 class="admin-titre">Rencontrez notre Équipe d'Administration UniForTech</h1>
            <div class="image-admins">
                <div class="admin1">
                    <img src="./static/img/accueil/Rectangle 13.png" alt="" class="img-adm1 admnimg">
                    <h1 class="nom-admin">User 1</h1>
                    <p class="txt-admin">Responsable de Contenu</p>
                </div>
                <div class="admin2">
                 <img src="./static/img/accueil/Rectangle 11.png" alt="" class="img-adm2 admnimg">
                 <h1 class="nom-admin">User 2</h1>
                 <p class="txt-admin">Responsable Technique</p>
                </div>
                <div class="admin3">
                   <img src="./static/img/accueil/Rectangle 12.png" alt="" class="img-adm3 admnimg">
                  <h1 class="nom-admin">User 3</h1>
                  <p class="txt-admin">Responsable de Communication</p>
                </div>
            </div>
            <button onclick="window.location.href = './pages/contact.php'"  class="button btn-Contact-admin">
            <span class="button-text">Contact</span>
            <div class="fill-container"></div>
            </button>
        </section>

     <?php echo include('./pages/footer_index.php');?>
    <?php
       echo'<link rel="stylesheet" href="./static/css/index.css">'; }
    ?>

    </body>

    </html>
