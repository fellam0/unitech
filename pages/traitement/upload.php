<?php
session_start();
// Vérifier si le formulaire a été soumis et si un fichier a été téléchargé
if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    // Emplacement de stockage des fichiers téléchargés
    $target_dir = "../../static/img/";

    // Nom du fichier téléchargé
    $file_name = basename($_FILES['photo']['name']);

    // Chemin d'accès complet du fichier téléchargé
    $target_file = $target_dir . $file_name;

    // Vérifier si le fichier est une image réelle ou une fausse image
    $check = getimagesize($_FILES['photo']['tmp_name']);
    if($check !== false) {
        // L'élément téléchargé est une image valide

        // Déplacer le fichier téléchargé vers l'emplacement de stockage sur le serveur
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            // Le fichier a été téléchargé avec succès, vous pouvez maintenant enregistrer le chemin d'accès dans la base de données

            // Inclure le fichier de configuration de la base de données
            include("../../config/config.php");

            // Requête SQL pour mettre à jour la colonne photo_profil dans la table etudiant
            $requete_update_photo = "UPDATE etudiant SET photo_profil = ? WHERE id = ?";
            $stmt = $connexion->prepare($requete_update_photo);
            $stmt->bind_param("ss", $target_file, $_SESSION['utilisateur']);
            $stmt->execute();

            // Fermeture de la connexion à la base de données
            $stmt->close();
            $connexion->close();

            // Redirection vers la page de profil avec un message de succès
            header("Location: ../profil.php?success=Photo de profil mise à jour avec succès.");
            exit();
        } else {
            // Erreur lors du déplacement du fichier téléchargé
            header("Location: ../profil.php?error=Erreur lors du téléchargement de la photo de profil.");
            exit();
        }
    } else {
        // Le fichier téléchargé n'est pas une image valide
        header("Location: ../profil.php?error=Le fichier téléchargé n'est pas une image valide.");
        exit();
    }
} else {
    // Redirection vers la page de profil avec un message d'erreur si aucun fichier n'a été téléchargé ou si une erreur est survenue
    header("Location: ../profil.php?error=Erreur lors du téléchargement de la photo de profil.");
    exit();
}
?>
