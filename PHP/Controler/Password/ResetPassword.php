<?php
require('../../Model/Password/ResetPassword.php');
require('../../View/Password/ResetPassword.php');
session_start();
require_once '../../Model/BDD/ConnexionBDD.php';
//On récupère les données de la table User
error_reporting(E_ALL);
ini_set("display_errors", 1);


try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}


$mail = $_GET["email"];
$_SESSION["mail"] = $mail;
echo 'email : ' . $mail;

    $creation = getCreationToken($mail); // Date de création du Token
    print($creation);
    $interval = strtotime($creation . '5 minutes'); // On crée un intervale de 5 minutes
    $date = date("Y-m-d H:i:s", $interval); // On crée une date fictive avec l'intervale de 5 minutes en plus
    $now = date("Y-m-d H:i:s"); // Maintenant
    if ($now<=$date) { // Si le token est valide (-5 mins), on envoie sur la page de modification
        print('On est dans le if de la date');
        if (isset($_POST["submit"])) {
            $pass1 = $_POST["pass1"];
            $pass2 = $_POST["pass2"];
            if ($pass1 != $pass2) { // si les mdp sont différents, on renvoie sur la page de changement
                header('Location : ../../View/Password/ResetPassword.php');
            } else { // sinon on fait la modif
                changePassword($mail, $pass1);
                header('Location : ../../View/Accueil/Accueil.php');
            }
        }
    } else { // Sinon on renvoie sur la demande de modification
        header('Location :../../View/Password/RequestResetPassword.php');
    }

