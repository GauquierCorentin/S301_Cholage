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
    $date = date("Y-m-d H:i:s");
    $insertToken = $pdo->prepare('INSERT INTO token (token, creation, email) VALUES (?, ?, ?)');
    $insertToken->execute(array($token, $date,$email ));

}