<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../login_form.php");
    exit();
}

// Inclure le fichier de configuration de la base de données
include("../../config/config.php");

// Vérifier si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : '';

    // Récupérer les données envoyées depuis le formulaire
    $currentPassword = isset($_POST['current-password']) ? $_POST['current-password'] : '';
    $newPassword = isset($_POST['new-password']) ? $_POST['new-password'] : '';
    $repeatPassword = isset($_POST['repeat-password']) ? $_POST['repeat-password'] : '';

    // Vérifier le mot de passe actuel dans la base de données
    $stmt = $connexion->prepare("SELECT mot_de_passe FROM etudiant WHERE id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    if (!password_verify($currentPassword, $hashedPassword)) {
        // Mot de passe actuel incorrect
        header("Location: ../profil.php?error=Le mot de passe actuel est incorrect.");
        exit();
    }
        // Vérification de la force du nouveau mot de passe
        if (!preg_match('/^(?=.*[A-Z]).{8,}$/', $newPassword)) {
            // Le mot de passe ne respecte pas les critères
            header("Location: ../profil.php?error=Le nouveau mot de passe doit contenir au moins 8 caractères avec au moins une majuscule..#error-message");
            exit();
        }
    
    // Hasher le nouveau mot de passe
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

    // Mettre à jour le mot de passe dans la base de données
    $updateStmt = $connexion->prepare("UPDATE etudiant SET mot_de_passe = ? WHERE id = ?");
    $updateStmt->bind_param("ss", $newPasswordHash, $userId);
    $updateStmt->execute();
    $updateStmt->close();

    // Redirection vers la page de paramètres avec un message de succès
    header("Location: ../profil.php?success=Le mot de passe a été mis à jour avec succès.");
    exit();
} else {
    // Redirection vers la page de paramètres si la méthode n'est pas POST
    header("Location: ../profil.php");
    exit();
}
?>
