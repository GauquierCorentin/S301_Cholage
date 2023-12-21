<?php
include ("../../Model/BDD/ConnexionBDD.php");
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
 * @param $token
 * @return mixed
 * @author Gallouin Matisse
 * permet de récupérer l'équipe lié au token demandé
 */

function getequipeToken($token){
    global $pdo;
    $req=$pdo->prepare("Select idequipe from token where token=?");
    $req->execute(array($token));
    return $req->fetch();
}

/**
 * @param $token
 * @return mixed
 * @author Gallouin Matisse
 * permet d'obtenir l'heure précise à laquelle le token a été créé
 */
function getCreationToken($token)
{
    global $pdo;
    $date = $pdo->prepare('select creation from token where token = ? and isinvitation=true');
    $date->execute(array($token));
    $getDate = $date->fetch();
    return $getDate;
}

/**
 * @param $idequipe
 * @return mixed
 * @author Gallouin Matisse
 * permet d'obtenir le nom d'une équipe à l'aide de son id
 */
function getNomEquipe($idequipe){
    global $pdo;
    $req=$pdo->prepare("Select nom from equipe where idequipe=? ");
    $req->execute(array($idequipe));
    $rep=$req->fetch();
    return $rep;
}

/**
 * @param $token
 * @return void
 * @author Gallouin Matisse
 * permet de supprimer le token dans la BDD afin d'éviter qu'il puisse etre réutilisé plus tard
 */

function deleteToken($token){
    global $pdo;
    $req=$pdo->prepare("Delete from token where token=?");
    $req->execute(array($token));
}

/**
 * @param $idequipe
 * @param $mail
 * @param $token
 * @return void
 * @author Gallouin Matisse
 * permet de rejoindre l'équipe demandé ainsi que d'envoyer un mail afin de notifier l'utilisateur qu'il a bien rejoint l'équipe
 */
function rejoindreEquipe($idequipe,$mail,$token){
    global $pdo;
    $req=$pdo->prepare("Update users set equipe_id=? where email=?");
    $req->execute(array($idequipe,$mail));
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
        $mailer->Subject = 'Equipe rejointe';

        $mailer->Body = 'Vous avez rejoint l\'équipe '.getNomEquipe($idequipe)[0];
        $mailer->addAddress($mail);
        $mailer->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
    deleteToken($token);
}


