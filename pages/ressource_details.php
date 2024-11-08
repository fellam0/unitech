<?php
session_start();
include('../config/config.php');
// Récupérer l'ID de la ressource depuis l'URL
if (isset($_GET['id'])) {
    $resource_id = $_GET['id'];

    // Récupérer les détails complets de la ressource depuis la base de données en fonction de l'ID
    $sql = "SELECT * FROM ressources WHERE id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $resource_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $titre = $row['titre'];
        $categorie = $row['categorie'];
        $niveau = $row['niveau'];
        $langue = $row['langue'];
        $description = $row['description'];
        $nom_utilisateur = $row['nom_utilisateur'];
        $pdf_filename = $row['pdf']; // Nom du fichier PDF à partir de la base de données

        // Chemin correct du PDF dans votre structure de dossiers
        $pdf_path = "../static/pdf/ressources/" . $pdf_filename;

        // Ajoutez d'autres champs de la base de données que vous souhaitez afficher
    } else {
        // Redirection vers une page d'erreur si la ressource n'est pas trouvée
        header("Location: error.php");
        exit();
    }
} else {
    // Redirection vers une page d'erreur si l'ID de la ressource n'est pas spécifié
    header("Location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la ressource</title>
    <link rel="stylesheet" href="../static/css/ressource_details.css">
    <link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div>
     <a href="./ressources.php" class="back-arrow"></a>
   </div>
<div class="book-details-container">
    <div class="book-details-pdf">
        <!-- Affichage du PDF -->
        <embed src="<?php echo $pdf_path; ?>" type="application/pdf" width="600px" height="500px" />
    </div>
    <div class="book-details-info">
        <div class="infocontainer">
        <div class="booktitle">
            <p class="booktitle"> <?php echo $titre; ?></p>
            <hr class="titleline">
        </div>
        <div class="categorie">
             <div class="cattitle"><p>Categorie:</p></div>
             <div class="catcontenu"><p> <?php echo $categorie; ?></p></div> 
        </div>
        <div class="niveau">
              <div class="nivtitle"><p>Niveau:</p></div>
              <div class="nivcontenu"><p><?php echo $niveau; ?></p></div>
        </div>
        <div class="langue">
             <div class="lantitle"><p>Langue:</p></div>
             <div class="langcontenu"><p> <?php echo $langue; ?></p></div> 
        </div>
        <div class="description">
              <div class="descriptitle"><p>Description:</p></div>
              <div class="descripcontenu"><p><?php echo $description; ?></p></div>
        </div>
        <div class="username">
              <div class="usertitle"><p>Publié par:</p></div>
              <div class="usercontenu"><?php echo '<p><a class="user-hover" href="./profil_etudiant.php?user='. htmlspecialchars($row['nom_utilisateur']) . '">' . htmlspecialchars($row['nom_utilisateur']) . '</a></p>'; ?></div>
        </div>
        <!-- ________________________________________________ -->
    
        <!-- Lien pour télécharger le PDF -->
        <div class="boutoncontainer">
            <div class="button-wrapper">
                <a href="<?php echo $pdf_path; ?>" class="button"  id="download-button" download>
                    <span class="text" style="height:10px;">Télécharger le PDF</span>
                    <span class="icon">
                        <svg style="background-color:#9f1016;"xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15V3m0 12l-4-4m4 4l4-4M2 17l.621 2.485A2 2 0 0 0 4.561 21h14.878a2 2 0 0 0 1.94-1.515L22 17"></path></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('download-button');
        const text = button.querySelector('.text');
        const icon = button.querySelector('.icon');

        button.addEventListener('mouseover', function () {
            text.style.display = 'none';
            icon.style.display = 'flex';
        });

        button.addEventListener('mouseout', function () {
            text.style.display = 'block';
            icon.style.display = 'none';
        });
    });
</script>
</body>
</html>
