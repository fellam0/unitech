<?php
$servername = "localhost"; // Adresse du serveur
$username = "root";        // Nom d'utilisateur
$password = "";            // Mot de passe
$dbname = "bdd_projet";  // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>
