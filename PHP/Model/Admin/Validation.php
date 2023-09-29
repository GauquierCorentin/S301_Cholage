<?php
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

$requete = $pdo->prepare('SELECT * FROM users WHERE isvalidate = false');
$requete->execute();
$usersNonValidate = $requete->fetchAll(PDO::FETCH_ASSOC);
//On modifie la valeur de isValidate à true

global $email;
if(isset($email)){
    echo ('On est dans la fonction pour valider un user');
    $requete = $pdo->prepare('UPDATE users SET isvalidate = true WHERE email = ?');
    $requete->execute(array($email));
    header('Location: ../../Controler/Admin/Validation.php');
}