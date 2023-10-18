<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
require_once '../../Model/BDD/ConnexionBDD.php';
session_start();
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

//On vérifie si l'utilisateur a déjà un token
$tokenUser = getToken($email);

//Si l'utilisateur a déjà un token, on update le token
if($tokenUser){
    UpdateToken($token,$email);
}
else{
    //Sinon on insère le token dans la base de données
    insertToken($token,$email);
}

//Si l'email n'existe pas, on affiche un message d'erreur
if (!$user) {
    echo 'Cet email n\'existe pas';
    exit();
}

//Envoie du mail avec le token dans l'url
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
    $mailer->setFrom('cholage.offi@gmail.com', 'Cholage');
    $mailer->Subject = 'Réinitialisation de votre mot de passe';
    //Remplacer le "S301_Cholage" par le nom du dossier qui contient le projet
    $mailer->Body='Bonjour, cliquez sur ce lien pour 
    réinitialiser votre mot de passe :
    http://localhost:63342/S301_Cholage/PHP/Controler/Password/ResetPassword.php?email='.$email.'&token='.$token.'';
    $mailer->addAddress($email);
    $mailer->send();
    echo 'Message has been sent';
    header('Location: ../../View/Accueil/Accueil.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
}
