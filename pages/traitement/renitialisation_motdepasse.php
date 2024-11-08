<?php
// Démarrer la session
session_start();
require 'db_connect.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $code_reinitialisation = $_POST['code_reinitialisation'];
    $nouveau_motdepasse = $_POST['nouveau_motdepasse'];
    $confirmer_motdepasse = $_POST['confirmer_motdepasse'];

    // Vérification de la correspondance des mots de passe
    if ($nouveau_motdepasse !== $confirmer_motdepasse) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: reinitialisation_motdepasse.php");
        exit();
    }

    // Recherche de l'utilisateur avec l'email et le code de réinitialisation valide
    $stmt = $conn->prepare("SELECT * FROM etudiant WHERE email = ? AND code_reinitialisation = ?");
    $stmt->bind_param("ss", $email, $code_reinitialisation);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Vérifier si le code de réinitialisation a expiré
        $expiration = $user['expiration_code_reinitialisation'];
        if (strtotime($expiration) < time()) {
            $_SESSION['error'] = "Le code de réinitialisation a expiré.";
            header("Location: reinitialisation_motdepasse.php");
            exit();
        }

        // Hachage du nouveau mot de passe
        $hash_motdepasse = password_hash($nouveau_motdepasse, PASSWORD_DEFAULT);

        // Mise à jour du mot de passe dans la base de données
        $update = $conn->prepare("UPDATE etudiant SET motdepasse = ?, code_reinitialisation = NULL, expiration_code_reinitialisation = NULL WHERE email = ?");
        $update->bind_param("ss", $hash_motdepasse, $email);
        if ($update->execute()) {
            $_SESSION['success'] = "Votre mot de passe a été réinitialisé avec succès.";
        } else {
            $_SESSION['error'] = "Échec de la mise à jour du mot de passe.";
        }
    } else {
        $_SESSION['error'] = "Le code de réinitialisation ou l'email est incorrect.";
    }

    header("Location: reinitialisation_motdepasse.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Réinitialiser le mot de passe</h2>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    ?>
    <form action="reinitialisation_motdepasse.php" method="POST">
        <label for="email">Votre email :</label>
        <input type="email" id="email" name="email" required>
        
        <label for="code_reinitialisation">Code de réinitialisation :</label>
        <input type="text" id="code_reinitialisation" name="code_reinitialisation" required>

        <label for="nouveau_motdepasse">Nouveau mot de passe :</label>
        <input type="password" id="nouveau_motdepasse" name="nouveau_motdepasse" required>

        <label for="confirmer_motdepasse">Confirmer le mot de passe :</label>
        <input type="password" id="confirmer_motdepasse" name="confirmer_motdepasse" required>

        <button type="submit">Réinitialiser le mot de passe</button>
    </form>
</body>
</html>
