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

function getCreationToken($mail) {
    global $pdo;
    $date = $pdo->prepare('select creation from token where email = ?');
    $date->execute(array($mail));
    $getDate=$date->fetch();
    return $getDate[0];
}

function changePassword($mail, $pass) {
    global $pdo;
    $change = $pdo->prepare('update users set password = ? where email = ?');
    $change->execute(array($pass, $mail));

}