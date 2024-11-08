<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/mdp_oublier.css">
    <link rel="icon" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
    <div class="container">
        <h3>Définir un nouveau mot de passe</h3>
        <form action="traitement/traitement_nouveau_motdepasse.php" method="POST">
         <label for="nouveau_motdepasse">Nouveau mot de passe :</label>
         <input type="password" name="nouveau_motdepasse" required>
         <label for="confirmer_motdepasse">Confirmer le mot de passe :</label>
         <input type="password" name="confirmer_motdepasse" required>
         <button type="submit">Valider</button>
        </form>

    </div>
</body>
</html>
