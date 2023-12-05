<?php
include "GestionEquipe.php";
require("../../Model/Includes/PHPMailer/src/Exception.php");
require("../../Model/Includes/PHPMailer/src/PHPMailer.php");
require ("../../Model/Includes/PHPMailer/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail=$_POST["mail"];
$equipe=$_POST["equipe"];


$token=bin2hex(random_bytes(24));
$token=base64_encode($token);
    if (getToken($mail,$equipe)!=null){
        UpdateToken($token,$mail,$equipe);
    }else{
        insertToken($token,$mail,$equipe);
    }
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
        $mailer->Subject = 'Invitation dans une équipe';

        $mailer->Body = 'Bonjour, nous vous indiquons que vous avez été inviter dans l\'équipe '.getNomEquipe($equipe)[0]."\nVous pouvez la rejoindre à l\'aide du lien suivant http://localhost:63342/S301_Cholage/PHP/Controller/Tournoi/Invitation.php?email=".$mail."&token=".$token."&equipe=".$equipe;
        $mailer->addAddress($mail);
        $mailer->send();
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
    exit();