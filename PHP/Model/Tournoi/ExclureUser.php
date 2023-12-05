<?php
include "GestionEquipe.php";
require("../../Model/Includes/PHPMailer/src/Exception.php");
require("../../Model/Includes/PHPMailer/src/PHPMailer.php");
require ("../../Model/Includes/PHPMailer/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
$iduser=$_POST["mail"];
$nomEquipe=getNomEquipeByMail($iduser);
global $pdo;
$req = $pdo->prepare("Update users set equipe_id=null,iscaptain=false where email=?");
$req->execute(array($iduser));
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
    $mailer->Subject = 'Exclusion de l\'équipe';

    $mailer->Body = 'Bonjour, nous vous indiquons que vous avez été exclu de l\'équipe '.$nomEquipe[0];
    $mailer->addAddress($iduser);
    $mailer->send();
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
}
exit();