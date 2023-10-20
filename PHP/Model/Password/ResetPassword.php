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

// Récupération du token lié au mail donné
/**
 * @param $mail
 * @return DateTime
 * @author Weber, Williame
 */
function getCreationToken($mail)
{
    global $pdo;
    $date = $pdo->prepare('select creation from token where email = ?');
    $date->execute(array($mail));
    $getDate = $date->fetchAll();
    return $getDate[0]['creation'];
}

// Modification du mot de passe lié au mail donné
/**
 * @param $mail
 * @param $pass
 * @return void
 * @author Weber
 */
function changePassword($mail, $pass)
{
    global $pdo;
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $change = $pdo->prepare('update users set password = ? where email = ?');
    $change->execute(array($pass, $mail));
}
