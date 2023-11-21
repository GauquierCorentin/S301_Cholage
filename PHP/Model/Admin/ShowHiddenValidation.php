<?php
require_once '../../Model/BDD/ConnexionBDD.php';
//On récupère les données de la table User
error_reporting(E_ALL);
ini_set("display_errors", 1);
//Require pour utiliser pph mailer
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
 * On récupère tout les users caché de la bdd
 * @author WILLIAME Anthony
 * @return void
 */
function getUsersHidden(){
    global $pdo;
    $requete=$pdo->prepare('SELECT * FROM users WHERE hidden= true order by email');
    $requete->execute();
    $usersHidden = $requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["usersHidden"]=$usersHidden;
}

/**
 * On update la valeur de isValidate à true et on attribut la date du jour à la date de validation
 * @author WILLIAME Anthony, GALLOUIN Matisse
 * @param $email
 *
 */
function setValidation($email)
{
    global $pdo;
    $requete = $pdo->prepare('UPDATE users SET isvalidate = true WHERE email = ?');
    $requete->execute(array($email));

    $date = date("Y-m-d");
    $req = $pdo->prepare('UPDATE users SET datevalidation=? WHERE email = ?');
    $req->execute(array($date, $email));

    //Envoie d'un mail afin de prévenir de la validation de la cotisation
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
        $mailer->Subject = 'Validation de votre cotisation';
        //Remplacer le "S301_Cholage" par le nom du dossier qui contient le projet
        $mailer->Body = 'Bonjour, nous avons le plaisir de vous annoncer que votre cotisation a bien été prise en compte';
        $mailer->addAddress($email);
        $mailer->send();
        echo 'Message has been sent';
        header('Location: ../../Controller/Admin/ShowHiddenValidation.php');
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
}

/**
 * Fonction qui update la variable hidden a false
 * @author WILLIAME Anthony
 * @param $email
 * @return void
 */
function updateHidden($email){
    global $pdo;
    $requete = $pdo->prepare('UPDATE users SET hidden = false WHERE email = ?');
    $requete->execute(array($email));
}