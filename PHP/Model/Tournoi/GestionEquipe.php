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
ob_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

function getMembre_Role($idequipe){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email,iscaptain from users where equipe_id=?");
    $req->execute(array($idequipe));
    $rep=$req->fetchAll();
    return $rep;
}
function getNomEquipe($idequipe){
    global $pdo;
    $req=$pdo->prepare("Select nom from equipe where idequipe=? ");
    $req->execute(array($idequipe));
    $rep=$req->fetch();
    return $rep;
}
function getMembreSansEquipe(){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email from users where equipe_id is null");
    $req->execute();
    $rep=$req->fetchAll();
    return $rep;
}
function supprUser($iduser){
    global $pdo ;
    $req=$pdo->prepare("Update users set equipe_id=null,iscaptain=false where email=?");
    $req->execute(array($iduser));
    $_SESSION["equipe"]=null;
    $_SESSION["isCaptain"]=null;
}
function verifequipe($iduser){
    global $pdo;
    $req=$pdo->prepare("Select equipe_id from users where email=?");
    $req->execute(array($iduser));
    return $req->fetch();
}
function insertToken($token,$email)
{
    global $pdo;
    $date = date("Y-m-d H:i:s");
    $insertToken = $pdo->prepare('INSERT INTO token VALUES (?, ?, ?,true)');
    $insertToken->execute(array($token, $date,$email ));
}
function UpdateToken($token,$email){
    global $pdo;
    $date = date("Y-m-d H:i:s");
    $update = $pdo->prepare('UPDATE token SET token = ?,creation=? WHERE email = ?');
    $update->execute(array($token,$date,$email));
}
function getToken($email){
    global $pdo;
    $getToken = $pdo->prepare('SELECT * FROM token WHERE email = ? and isinvitation!=false');
    $getToken->execute(array($email));
    $token = $getToken->fetch();
    return $token;
}
function inviter($mail,$equipe){
    $token=bin2hex(random_bytes(24));
    $token=base64_encode($token);
    if (getToken($mail)!=null){
        UpdateToken($token,$mail);
    }else{
        insertToken($token,$mail);
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

        $mailer->Body = 'Bonjour, nous vous indiquons que vous avez été inviter dans l\'équipe '.getNomEquipe($equipe)[0]."\nVous pouvez la rejoindre à l\'aide du lien suivant http://localhost:63342/S301_Cholage/PHP/Controller/GestionEquipe/Invitation.php?email='.$mail.'&token='.$token;";
        $mailer->addAddress($mail);
        $mailer->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
    exit();

}