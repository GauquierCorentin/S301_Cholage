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
function getCreationToken($token)
{
    global $pdo;
    $date = $pdo->prepare('select creation from token where token = ? and isinvitation=true');
    $date->execute(array($token));
    $getDate = $date->fetch();
    echo $getDate;
    return $getDate;
}
function getNomEquipe($idequipe){
    global $pdo;
    $req=$pdo->prepare("Select nom from equipe where idequipe=? ");
    $req->execute(array($idequipe));
    $rep=$req->fetch();
    return $rep;
}

function deleteToken($mail){}
function rejoindreEquipe($idequipe,$mail){
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
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
    exit();
}


