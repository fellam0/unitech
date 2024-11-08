<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifier si l'utilisateur a passé la vérification du code
if (!isset($_SESSION['verified']) || $_SESSION['verified'] !== true) {
    header("Location: motdepasse_oublier.php");
    exit();
}

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "bdd_projet");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nouveau_motdepasse = $_POST['nouveau_motdepasse'];
    $confirmer_motdepasse = $_POST['confirmer_motdepasse'];
    $email = $_SESSION['email'];

    // Vérifier si les deux mots de passe correspondent
    if ($nouveau_motdepasse !== $confirmer_motdepasse) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: nouveau_motdepasse.php");
        exit();
    }

    // Hachage du nouveau mot de passe
    $motdepasse_hash = password_hash($nouveau_motdepasse, PASSWORD_DEFAULT);

    // Mettre à jour le mot de passe dans la base de données
    $stmt = $conn->prepare("UPDATE utilisateurs SET mot_de_passe = ?, code_reinitialisation = NULL, expiration_code_reinitialisation = NULL WHERE email = ?");
    $stmt->bind_param("ss", $motdepasse_hash, $email);
    $stmt->execute();

    // Suppression des informations de session et redirection
    session_destroy();
    $_SESSION['success'] = "Votre mot de passe a été réinitialisé avec succès.";
    header("Location: login_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau mot de passe</title>
</head>
<body>
    <h2>Nouveau mot de passe</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form action="nouveau_motdepasse.php" method="POST">
        <label for="nouveau_motdepasse">Nouveau mot de passe :</label>
        <input type="password" name="nouveau_motdepasse" required><br>
        <label for="confirmer_motdepasse">Confirmer le mot de passe :</label>
        <input type="password" name="confirmer_motdepasse" required><br>
        <button type="submit">Réinitialiser</button>
    </form>
</body>
</html>

