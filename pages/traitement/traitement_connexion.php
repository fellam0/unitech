<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('../../config/config.php');
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Utilisation de requête préparée pour éviter les injections SQL
    $requete_utilisateur = "SELECT id, mot_de_passe FROM etudiant WHERE email = ? LIMIT 1";
    $stmt = $connexion->prepare($requete_utilisateur);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultat = $stmt->get_result();

    if ($resultat->num_rows == 1) {
        $utilisateur = $resultat->fetch_assoc();
        if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // Si l'email et le mot de passe sont corrects
            $_SESSION['utilisateur'] = $utilisateur['id'];
            $_SESSION['type_utilisateur'] = 'etudiant'; // Ajout du type utilisateur
            header("Location:../../index.php");
            exit();
        }
    }

    // Si l'email ou le mot de passe est incorrect
    $connexion->close(); // Fermer la connexion à la base de données
    header("Location: ../login_form.php?error_mail_mdp=Email ou Mot de passe incorrect.");
    exit();
} else {
    header("Location: ../login_form.php");
    exit();
}
?>
