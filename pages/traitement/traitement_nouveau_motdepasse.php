<?php
session_start();
$conn = new mysqli("localhost", "root", "", "bdd_projet");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nouveau_motdepasse = $_POST['nouveau_motdepasse'];
    $confirmer_motdepasse = $_POST['confirmer_motdepasse'];
    $email = $_SESSION['email'];

    if ($nouveau_motdepasse === $confirmer_motdepasse) {
        $motdepasse_hash = password_hash($nouveau_motdepasse, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE etudiant SET mot_de_passe = ?, code_reinitialisation = NULL, expiration_code_reinitialisation = NULL WHERE email = ?");
        $stmt->bind_param("ss", $motdepasse_hash, $email);
        $stmt->execute();

        session_destroy();
        header("Location: ../login_form.php"); // Redirige vers la page de connexion après le changement de mot de passe
        exit();

    } else {
        header("Location: nouveau_motdepasse.php?error=Les mots de passe ne correspondent pas");
    }
}
