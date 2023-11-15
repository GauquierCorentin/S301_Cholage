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
//Requetes pour récupérer tout les users
/**
 * On récupère tout les users de la bdd
 * @author WILLIAME Anthony
 * @return array
 */
function getusers()
{
    global $pdo;
    $requete = $pdo->prepare('SELECT * FROM users order by email');
    $requete->execute();
    $users = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

/**
 * On récupère les utilisateur et on leurs attribut une date de validation qui dure un an
 * @author WILLIAME Anthony
 */
function setDateValidation()
{
    global $pdo;
    $users=getusers();
    foreach ($users as $item) {
        $date = $item['datevalidation'];
        $datephp = date("Y-m-d");
        $dateValidUnAn = date("Y-m-d", strtotime($date . "+1 year"));
        //Si la date de validation à un an de moins que la date du jour on update le users
        if ($dateValidUnAn <= $datephp) {
            $requete = $pdo->prepare('UPDATE users SET isvalidate = false WHERE email = ?');
            $requete->execute(array($item['email']));
        }
    }
}
//Request pour récupérer les users non validé
/**
 * On récupère tout les users non validé de la bdd et on les
 * stock dans une variable de session pour les afficher dans la vue Validation.php
 * @author WILLIAME Anthony
 */
function getUsersNonValidate()
{
    global $pdo;
    $requete=$pdo->prepare('SELECT * FROM users WHERE isvalidate= false or datevalidation = null order by email');
    $requete->execute();
    $usersNonValidate = $requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["usersNonValidate"]=$usersNonValidate;
}
//On modifie la valeur de isValidate à true

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
        header('Location: ../../Controler/Admin/Validation.php');
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
}

