<?php
require_once '../../Model/BDD/ConnexionBDD.php';

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

//On vérifie que l'email existe dans la base de données
function checkEmail($email)
{
    global $pdo;
    $checkEmail = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $checkEmail->execute(array($email));
    $user = $checkEmail->fetch();
    return $user;
}

function insertToken($token,$email)
{
    global $pdo;
//On insère le token dans la base de données et on rajoute 5min à la date d'expiration
    $req=$pdo->prepare('UPDATE users SET token = ?, 
                 reset_at = (NOW() + INTERVAL 1 MINUTE) WHERE email = ?');
    $req->execute(array($token,$email));
}