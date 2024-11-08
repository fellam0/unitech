<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/Exception.php';
require '../../PHPMailer-master/PHPMailer.php';
require '../../PHPMailer-master/SMTP.php';

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "bdd_projet");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Si le formulaire est soumis

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Vérifier si l'email existe dans la base de données
    $stmt = $conn->prepare("SELECT * FROM etudiant WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Générer un code de réinitialisation
        $code = rand(100000, 999999); // Code à 6 chiffres
        $expiration = date("Y-m-d H:i:s", strtotime("+10 minutes")); // Expiration dans 10 minutes

        // Mettre à jour la base de données avec le code de réinitialisation et la date d'expiration
        $stmt = $conn->prepare("UPDATE etudiant SET code_reinitialisation = ?, expiration_code_reinitialisation = ? WHERE email = ?");
        $stmt->bind_param("sss", $code, $expiration, $email);
        $stmt->execute();

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

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'Code de réinitialisation de mot de passe';
            $mail->Body    = "<h3>Votre code de réinitialisation est : $code</h3><p>Ce code est valide pendant 10 minutes.</p>";

            $mail->send(); // Envoi de l'email
            $_SESSION['email'] = $email; // Stocker l'email dans la session
            $_SESSION['code'] = $code; //stocker le code généré dans la session
            header("Location: ../verifier_code.php"); // Rediriger vers la page de vérification du code
            exit();
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi du mail: {$mail->ErrorInfo}"; // En cas d'erreur
        }
    } else {
        header("Location: ../motdepasse_oublier.php?error=Email non trouvé");
        exit();
    }
}
?>
