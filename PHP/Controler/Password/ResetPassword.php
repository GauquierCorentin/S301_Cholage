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
echo 'email : ' . $mail;

$pass1 = $_POST["pass1"];
$pass2 = $_POST["pass2"];

// Si mdp == null, on fait la vérification de token
/*
if ($pass1 == null) {
    $creation = getCreationToken($mail);
    $now = date("Y-m-d H:i:s");
    $date = date("H:i:s",strtotime($now . + "5 minute"));
    if ($now<$date) {
        header('../../View/Password/ResetPassword.php');

    } else {
        $erreur = 'Délai de 5 minutes dépassé';
        header('../../View/Password/RequestResetPassword.php?error_message=$erreur');
    }
} else { // sinon, l'utilisateur est dans le process donc on fait la modif
    if ($pass1 != $pass2) { // si les mdp sont différents, on renvoie sur la page de changement
        $erreur = 'Les mots de passe ne correspondent pas';
        header('../../View/Password/ResetPassword.php?error_message=$erreur');
    } else { // sinon on fait la modif
        changePassword($mail, $pass1);
    }
}
*/
if (isset($_POST["pass1"])) {
    if ($pass1 != $pass2) { // si les mdp sont différents, on renvoie sur la page de changement
        $erreur = 'Les mots de passe ne correspondent pas';
        header('../../View/Password/ResetPassword.php?error_message=$erreur');
    } else { // sinon on fait la modif
        changePassword($mail, $pass1);
    }
} else {
    $creation = getCreationToken($mail);
    print($creation);
    $now = date("Y-m-d H:i:s");
    $date = date("Y-m-d H:i:s");
    print('La date avec 5min de + : '.$date);
    if ($now<$date) {
        header('../../View/Password/ResetPassword.php');

    } else {
        $erreur = 'Délai de 5 minutes dépassé';
        header('../../View/Password/RequestResetPassword.php?error_message=$erreur');
    }
}
