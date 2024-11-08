<?php include_once('../config/config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/contact.css">
    <link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
    <title>Contact</title>
</head>
<body>
<div class="container">
  <div class="form-container">
    <div class="left-container">
      <div class="left-inner-container">
        <h2 class="h2-contact">PARLONS ENSEMBLE</h2>
        <p>Que vous ayez une question, souhaitiez commencer un projet ou simplement vous connecter.</p>
        <br>
        <p>N'hésitez pas à m'envoyer un message via le formulaire de contact.</p>
    </div>
      </div>
    <div class="right-container">  
      <div class="right-inner-container">
      <?php
        // Démarrer la session
        session_start();

        // Si un message est défini, l'afficher
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            // Supprimer le message après l'avoir affiché
            unset($_SESSION['message']);
        }
      ?>
        <form action="./traitement/traitement_contact.php" method="POST">
            <h2 class="lg-view">Contact</h2>
            <h2 class="sm-view">Let's Chat</h2>
            <input type="text" name="nom" placeholder="Nom" required/>
            <input type="email" name="email" placeholder="Email" required/>
            <input type="phone" name="numero" placeholder="Phone(0......)" />
            <textarea rows="4" name="msg" placeholder="Message" required></textarea>
          <div class="btncont">
            <button class="button btn">
              <span class="button-text">Envoyer</span>
              <div class="fill-container"></div>
           </button>
           <button class="button btn" onclick="window.location.href='../index.php'">
              <span class="button-text">Annuler</span>
              <div class="fill-container"></div>
           </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
