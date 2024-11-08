<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier le code</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/mdp_oublier.css"> <!-- Lien vers ton CSS -->
    <link rel="icon" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="container">
        <h3>Vérification du code de réinitialisation</h3>
        <form action="traitement/traitement_verifier_code_inscription.php" method="POST">
            <label for="code">Entrez le code reçu par mail :</label>
            <input type="text" name="code" id="code" required>
            <button type="submit">Vérifier</button>
        </form>

        <?php if (isset($_GET['error'])) { ?>
            <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>
    </div>
</body>
</html>

