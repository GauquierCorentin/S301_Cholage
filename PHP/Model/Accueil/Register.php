<?php

require("../../Model/Includes/PHPMailer/src/Exception.php");
require("../../Model/Includes/PHPMailer/src/PHPMailer.php");
require ("../../Model/Includes/PHPMailer/src/SMTP.php");
require("../../Model/BDD/ConnexionBDD.php");
require("Premier.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Fonction d'inscription au site. Ecris toute les informations nécessaires dans la BDD, comprend également un envoi de
mail avec PHPMailer*/
/**
 * @param $mail
 * @param $mdp
 * @param $mdpcheck
 * @return bool|void
 * @author Corentin Gauquier
 */
function signIn($mail, $mdp, $mdpcheck)
{
    $session = new Premier();
    $session->premier('first');
    @$nom = $_POST['nom'];
    @$prenom = $_POST['prenom'];
    @$numtel= @$_POST['tel'];

    if ($_SESSION['first'] == 2) {
        if($mdp==$mdpcheck){
            try {
                $conn = ConnexionBDD::getInstance();
                $pdo = $conn::getpdo();
            } catch (PDOException $e) {
                die ('Erreur : ' . $e->getMessage());
            }
            $hash = password_hash($mdp, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users VALUES (:mail,:nom,:prenom,:numtel,:hash,null,false,false,false,false,false,0,null)";
            $req = $pdo->prepare($sql);
            $req->bindParam('mail',$mail);
            $req->bindParam('nom', $nom);
            $req->bindParam('prenom', $prenom);
            $req->bindParam('numtel', $numtel);
            $req->bindParam('hash', $hash);
            $user = $pdo->prepare("SELECT * FROM users WHERE email=?");
            $user->execute(array($mail));

            if ($user->fetch()) {
                ?>
                <script>Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Votre compte existe déjà.'
                    })</script>
                <?php
                return false;
            }

            try {
                $req->execute();
                $req->setFetchMode(PDO::FETCH_ASSOC);

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
                    $mailer->CharSet='UTF-8';
                    $mailer->setFrom('cholage.offi@gmail.com', 'Cholage');
                    $mailer->Subject = 'Compte créer avec succès !';
                    $mailer->Body='Votre compte a été créer dans le système avec succès, bienvenue !';
                    $mailer->addAddress($mail, 'Joe User');
                    $mailer->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
                }

            } catch (PDOException $e) {
                die($e->getMessage());
            }
            header('Location: Accueil.php');
            return true;
        }
    }
}

