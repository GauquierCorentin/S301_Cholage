<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once '../../Model/BDD/ConnexionBDD.php';
require_once '../../View/BarreMenu/BarreMenu.php';
require_once '../../Model/Password/RequestResetPassword.php';
require_once '../../View/Password/RequestResetPassword.php';

require("../../Model/Includes/PHPMailer/src/Exception.php");
require("../../Model/Includes/PHPMailer/src/PHPMailer.php");
require ("../../Model/Includes/PHPMailer/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

global $pdo;
global $user;

//Création d'un token aléatoire
try {
    $token = bin2hex(random_bytes(24));
    $token = base64_encode($token);
} catch (Exception $e) {
}

//Récupération de l'email
$email = $_POST['email'];

//On vérifie que l'email existe dans la base de données
$user = checkEmail($email);

//On insère le token dans la base de données et on rajoute 5min à la date d'expiration
insertToken($token,$email);

//Si l'email n'existe pas, on affiche un message d'erreur
if (!$user) {
    echo 'Cet email n\'existe pas';
    exit();
}

//Envoie du mail avec le token dans l'url et expiration au bout de 5min
$mailer= new PHPMailer(true);
try {

    //Server settings
    $mailer->SMTPDebug = 0;
    $mailer->isSMTP();
    $mailer->Host       = 'smtp.gmail.com';
    $mailer->SMTPAuth   = true;
    $mailer->Username   = 'cholage.offi@gmail.com';
    $mailer->Password   = 'fufvajtuygojmfro';
    $mailer->SMTPSecure = 'tls';
    $mailer->Port       = 587;
    //Recipients
    $mailer->setFrom('
    
    ', 'Cholage');
    $mailer->Subject = 'Réinitialisation de votre mot de passe';
    $mailer->Body='Bonjour, cliquez sur ce lien pour 
    réinitialiser votre mot de passe :
     http://localhost/S301_Cholage/PHP/View/Password/ResetPassword.php?email='.$email.'&token='.$token.'';
    $mailer->addAddress($email, 'Joe User');
    $mailer->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
}
