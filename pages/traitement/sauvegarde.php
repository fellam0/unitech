<?php
session_start();

include("../../config/config.php");
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../login_form.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_utilisateur = $_SESSION['utilisateur'];

    // Récupération des valeurs actuelles pour la préservation
    $query = "SELECT systeme, niveau, specialite FROM etudiant WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->bind_param("s", $id_utilisateur);
    $stmt->execute();
    $stmt->bind_result($ancien_systeme, $ancien_niveau, $ancienne_specialite);
    $stmt->fetch();
    $stmt->close();


    $systeme = !empty($_POST["systeme"]) ? $_POST["systeme"] : $ancien_systeme;
    $niveau = !empty($_POST["niveau"]) ? $_POST["niveau"] : $ancien_niveau;
    $specialite = !empty(trim($_POST["specialite"])) ? trim($_POST["specialite"]) : $ancienne_specialite;
    if ($systeme === "Ingénieur") {
        $specialite = ''; // Spécialité vide pour le système "Ingénieur"
    }
    // Requête SQL mise à jour de l'utilisateur
    $requete_update_utilisateur = "UPDATE etudiant SET systeme = ?, niveau = ?, specialite = ? WHERE id = ?";
    $stmt = $connexion->prepare($requete_update_utilisateur);
    $stmt->bind_param("ssss", $systeme, $niveau, $specialite, $id_utilisateur);

    if ($stmt->execute()) {
        // Redirection avec succès si la mise à jour de l'utilisateur a réussi
        header("Location: ../profil.php?success=Les paramètres du compte ont été mis à jour avec succès.");
    } else {
        // Gestion des erreurs si la mise à jour de l'utilisateur échoue
        error_log("Erreur de mise à jour SQL pour la table etudiant: " . $stmt->error);
        header("Location: ../profil.php?status=error");
    }
    $stmt->close();
    $connexion->close();
} else {
    header("Location: ../profil.php");
}
?>
