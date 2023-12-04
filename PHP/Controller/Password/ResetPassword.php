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

$creation = getCreationToken($mail); // Date de création du Token
$convertcreation=date_create($creation);
$expiration = $convertcreation; // Copie de $creation
$interval = date_interval_create_from_date_string("300 seconds"); // On crée un intervale de 5 minutes
$expiration->add($interval); // Date de création +5 minutes = date d'expiration
$now = date("Y-m-d H:i:s"); // Maintenant

if ($now <= $expiration) { // Si le token est valide (-5 mins), on envoie sur la page de modification
    if (isset($_POST["submit"])) {
        $pass1 = $_POST["pass1"];
        $pass2 = $_POST["pass2"];
        if ($pass1 != $pass2) { // si les mdp sont différents, on renvoie sur la page de changement
            $erreur = "Mots de Passe difféents";
            header('Location: ../../View/Password/ResetPassword.php');
        } else { // sinon on fait la modif
            changePassword($mail, $pass1);
            header('Location: ../../Controller/Accueil/Accueil.php');
        }
    }
} else { // Sinon on renvoie sur la demande de modification
    header('Location: ../../Controller/Password/RequestResetPassword.php');
}
