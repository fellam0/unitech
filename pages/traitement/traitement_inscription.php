<?php
include_once('../../config/config.php');
// Inclure PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/Exception.php';
require '../../PHPMailer-master/PHPMailer.php';
require '../../PHPMailer-master/SMTP.php';

// Fonction pour générer le nom d'utilisateur
function genererNomUtilisateur($nom, $prenom) {
    // Générer un nom d'utilisateur à partir du nom et du prénom, suivi de 3 chiffres aléatoires
    $nom_utilisateur = strtolower($prenom . "_" . $nom);
    $nom_utilisateur = preg_replace('/\s+/', '', $nom_utilisateur); // Supprimer les espaces
    $nom_utilisateur = substr($nom_utilisateur, 0, 20); // Limiter la longueur du nom d'utilisateur à 20 caractères
    $nom_utilisateur = $nom_utilisateur . rand(100, 999); // Ajouter 3 chiffres aléatoires
    return $nom_utilisateur;
}

// Fonction pour générer un identifiant unique de 7 caractères alphanumériques
function genererIdentifiantUnique() {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueur = 7;

    do {
        $identifiant = '';
        for ($i = 0; $i < $longueur; $i++) {
            $identifiant .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        // Vérifier si l'identifiant est déjà présent dans la base de données
        $requete_verif_identifiant = "SELECT id FROM etudiant WHERE id = ?";
        global $connexion;
        $stmt = $connexion->prepare($requete_verif_identifiant);
        $stmt->bind_param("s", $identifiant);
        $stmt->execute();
        $resultat = $stmt->get_result();
    } while ($resultat->num_rows > 0);

    return $identifiant;
}

// Récupération des données du formulaire
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];
$systeme = $_POST['systeme'];
$niveau = $_POST['niveau'];
$specialite = isset($_POST['specialite']) ? $_POST['specialite'] : '';

// Validation de l'email avec le format prénom.nom@gmail.com
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/^([a-zA-Z0-9._%+-]+)\.([a-zA-Z0-9._%+-]+)@gmail\.com$/", $email, $matches)) {
    // Si l'email n'est pas valide ou ne suit pas le format requis, rediriger vers le formulaire avec un message d'erreur
    header("Location: ../login_form.php?error=Adresse e-mail invalide. Utilisez le format prenom.nom@gmail.com");
    exit();
}
 // Extraction du prénom et du nom à partir de l'email
 $prenom = $matches[1]; // Le prénom est le premier groupe de capture dans l'expression régulière
 $nom = $matches[2]; // Le nom est le second groupe de capture
// Vérification de l'unicité de l'email
$requete_verif_email = "SELECT * FROM etudiant WHERE email = ?";
$stmt = $connexion->prepare($requete_verif_email);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultat_email = $stmt->get_result();

if ($resultat_email->num_rows > 0) {
    header("Location: ../login_form.php?error=Cette adresse e-mail est déjà utilisée. Veuillez en utiliser une autre");
    exit();
}

// Vérification de la force du mot de passe
if (!preg_match('/^(?=.*[A-Z]).{8,}$/', $mot_de_passe)) {
    // Le mot de passe ne respecte pas les critères
    header("Location: ../login_form.php?error=Le mot de passe doit contenir au moins 8 caractères avec au moins une majuscule");
    exit();
}

// Génération automatique de l'identifiant
$id = genererIdentifiantUnique();

// Génération automatique du nom d'utilisateur
$nom_utilisateur = genererNomUtilisateur($nom, $prenom);

// Hashage du mot de passe
$mot_de_passe_hashe = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Générer un code de confirmation
$code = rand(100000, 999999); // Code à 6 chiffres
$expiration = date("Y-m-d H:i:s", strtotime("+10 minutes")); // Expiration dans 10 minutes


// Configurer PHPMailer pour l'envoi de l'email
$mail = new PHPMailer(true);
try {
    // Paramètres du serveur SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'cours.universitecy@gmail.com'; // Remplacez par votre adresse email universitaire
    $mail->Password = 'xdsl hshc lwhv zgjf'; // Remplacez par le mot de passe de votre email universitaire
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL ou utilisez PHPMailer::ENCRYPTION_STARTTLS pour TLS
    $mail->Port = 465; // Utilisez 465 pour SSL: sécurisé 3la tls, ou 587 pour TLS

    // Destinataire
    $mail->setFrom('cours.universitecy@gmail.com', 'Unitech'); // Remplacez par votre adresse email
    $mail->addAddress($email); // L'email de l'utilisateur

    // Contenu du mail
    $mail->isHTML(true);
    $mail->Subject = 'Merci de confirmer votre adresse email';
    $mail->Body    = "<h3>Bienvenue chez Unitech ! Veuillez confirmer votre adresse email en saisissant le code : $code</h3><p>Ce code est valide pendant 10 minutes.</p>";

    $mail->send(); // Envoi de l'email

    session_start();
    $_SESSION['id'] = $id;
    $_SESSION['nom_utilisateur'] = $nom_utilisateur;
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['email'] = $email; // Stocker l'email dans la session
    $_SESSION['mot_de_passe'] = $mot_de_passe_hashe;
    $_SESSION['systeme'] = $systeme;
    $_SESSION['niveau'] = $niveau;
    $_SESSION['specialite'] = $specialite;
    $_SESSION['code'] = $code; //stocker le code généré dans la session
    header("Location: ../verifier_code.php"); // Rediriger vers la page de vérification du code
   
} 
catch (Exception $e) {
    echo "Erreur lors de l'envoi du mail: {$mail->ErrorInfo}"; // En cas d'erreur
} 
?>
