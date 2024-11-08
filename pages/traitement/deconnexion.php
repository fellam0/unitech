<?php
// Démarrer la session
session_start();
// Détruire la session
session_destroy();
// Rediriger vers la page d'accueil ou une autre page après la déconnexion
header("Location:../../index.php"); // Changez index.php en le chemin de la page vers laquelle vous souhaitez rediriger après la déconnexion
exit();
?>
