<?php
$serveur = "localhost"; // L'hôte de la base de données
$utilisateur = "root"; // Nom d'utilisateur MySQL
$mot_de_passe = ""; // Mot de passe MySQL
$base_de_donnees = "bdd_projet"; // Nom de la base de données

// Établir la connexion à la base de données
//creer une instance de la classe mysqli pour etablir la connexion
$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}
// Définir l'encodage des caractères à UTF-8
$connexion->set_charset("utf8");
?>
