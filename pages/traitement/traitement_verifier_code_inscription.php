<?php
include('../../config/config.php');
session_start();
$id = $_SESSION['id'];
$nom_utilisateur = $_SESSION['nom_utilisateur'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email']; 
$mot_de_passe_hashe = $_SESSION['mot_de_passe'];
$systeme = $_SESSION['systeme'];
$niveau = $_SESSION['niveau'];
$specialite = $_SESSION['specialite'];
$code = $_SESSION['code'];

echo $code;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //récuperer le code saisi par l'utilisateur 
    $code_introduit = $_POST['code'];

    if ($code_introduit == $code){

        // Insertion des données dans la base de données en utilisant des déclarations préparées
        global $connexion;
        $requete_insertion = "INSERT INTO etudiant (id, nom_utilisateur, nom, prenom, email, mot_de_passe, systeme, niveau, specialite) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connexion->prepare($requete_insertion);
        $stmt->bind_param("sssssssss", $id, $nom_utilisateur, $nom, $prenom, $email, $mot_de_passe_hashe, $systeme, $niveau, $specialite);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            header("Location: ../login_form.php?success=Inscription réussie. Vous pouvez maintenant vous connecter.");
        } 
        // Fermeture de la connexion à la base de données
        $stmt->close();
        $connexion->close();

    }else{
        header("Location: verifier_code.php?error=Code invalide ou expiré");
    }
    
}
    


?>