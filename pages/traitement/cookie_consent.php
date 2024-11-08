<?php
session_start();
require 'db_connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['consent'])) {
    $consent = $_POST['consent'] === 'true' ? 1 : 0;

    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['nom_utilisateur'])) {
        $nom_utilisateur = $_SESSION['nom_utilisateur'];

        // Mettre à jour la base de données avec le consentement ou le refus
        $query = "UPDATE etudiant SET consentement_cookies = ? WHERE nom_utilisateur = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('is', $consent, $nom_utilisateur);

        if ($stmt->execute()) {
            if ($consent == 1) {
                echo 'Consentement accepté avec succès.';
            } else {
                echo 'Consentement refusé avec succès.';
            }
        } else {
            echo 'Erreur lors de l\'enregistrement du consentement.';
        }
    } else {
        echo 'Utilisateur non authentifié.';
    }
} else {
    echo "Requête incorrecte.";
}
?>



