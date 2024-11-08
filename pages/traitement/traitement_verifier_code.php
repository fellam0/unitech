<?php
session_start();
$email = $_SESSION['email'];
$code = $_SESSION['code'];//on récupere le code envoyé par mail


if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code_introduit = $_POST['code'];//on récupere le code saisi par l'utilisateur

    if ( $code_introduit == $code){
        header("Location: ../nouveau_motdepasse.php"); // Redirige vers la page où l'utilisateur peut saisir un nouveau mot de passe
        exit();
    }

    else{
        header("Location: verifier_code.php?error=Code invalide ou expiré");
    }
}
