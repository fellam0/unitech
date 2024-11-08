<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/mdp_oublier.css">
    <link rel="icon" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="container">
        <h3>Réinitialisation de mot de passe</h3>
        <form action="./traitement/traitement_motdepasse_oublier.php" method="POST">
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Envoyer le code</button>
        </form>
        <?php if (isset($_GET['error'])) { ?>
            <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>
    </div>
</body>
</html>
