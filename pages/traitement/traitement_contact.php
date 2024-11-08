<?php
// Démarrer la session
session_start();

// Inclure le fichier de configuration de la base de données
include_once('../../config/config.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $numero = !empty($_POST['numero']) ? $_POST['numero'] : 0; // Utiliser 0 comme valeur par défaut
    $message = $_POST['msg'];

    // Vérifier que le numéro de téléphone commence par un "0" et contient un maximum de 10 chiffres
    // seulement si le champ numéro n'est pas vide
    if (!empty($numero) && !preg_match("/^0[0-9]{9}$/", $numero)) {
        $_SESSION['message'] = "Le numéro de téléphone doit commencer par un '0' et contenir un maximum de 10 chiffres.";
        header('Location: ../contact.php');
        exit;
    }

    // Préparer la requête SQL
    $sql = "INSERT INTO messages (nom, email, numero, message) VALUES (?, ?, ?, ?)";
    $stmt = $connexion->prepare($sql);

    // Lier les paramètres
    $stmt->bind_param("ssss", $nom, $email, $numero, $message);

    // Exécuter la requête
    if ($stmt->execute()) {
        $_SESSION['message'] = "Message envoyé avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de l'envoi du message.";
    }

    // Fermer la déclaration
    $stmt->close();

    // Rediriger vers la page de contact
    header('Location: ../contact.php');
    exit;
}

// Fermer la connexion
$connexion->close();
?>