<?php
require "../../Model/BDD/ConnexionBDD.php";
require("../../Model/Includes/PHPMailer/src/Exception.php");
require("../../Model/Includes/PHPMailer/src/PHPMailer.php");
require ("../../Model/Includes/PHPMailer/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
/**
 * @author Gallouin Matisse
 * ajout des users non organisateurs dans une session pour les transmettre à la view
 * @return void
 */
function recupUsersNonOrga()
{
    global $pdo;
    $requete=$pdo->prepare("SELECT * FROM users where isOrganisateur=FALSE order by email");
    $requete->execute();
    $resultat=$requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['users']=$resultat;
}

/**
 * @author Gallouin Matisse, Williame Anthony
 * fonction changer le statut du user
 * @param $email string
 * @return void
 */
function UpdateStatutAdd($email){
    global $pdo;
    $requete=$pdo->prepare("Update users set isOrganisateur=true where email=?");
    $requete->execute(array($email));

    $mailer = new PHPMailer(true);
    try {

        //Server settings
        $mailer->SMTPDebug = 0;
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = 'cholage.offi@gmail.com';
        $mailer->Password = 'fufvajtuygojmfro';
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;
        //Recipients
        $mailer->setFrom('cholage.offi@gmail.com', 'Cholage');
        $mailer->Subject = 'Nouvel Organisateur';
        //Remplacer le "S301_Cholage" par le nom du dossier qui contient le projet
        $mailer->Body = 'Bonjour, nous avons le plaisir de vous annoncer que vous devenez un Organisateur';
        $mailer->addAddress($email);
        $mailer->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
}