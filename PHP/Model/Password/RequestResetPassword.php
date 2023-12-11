<?php
require_once '../../Model/BDD/ConnexionBDD.php';

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

/**
 * On vérifie que l'email existe dans la bdd
 * @author WILLIAME Anthony
 * @param $email
 * @return array
 */
function checkEmail($email)
{
    global $pdo;
    $checkEmail = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $checkEmail->execute(array($email));
    $user = $checkEmail->fetch();
    return $user;
}

/**
 * On insère le token dans la bdd avec la date de création et l'email de l'utilisateur
 * @author  WILLIAME Anthony
 * @param $token
 * @param $email
 */
function insertToken($token,$email)
{
    global $pdo;
    $date = date("Y-m-d H:i:s");
    $insertToken = $pdo->prepare('INSERT INTO token (token, creation, email) VALUES (?, ?, ?)');
    $insertToken->execute(array($token, $date,$email));
}

/**
 * On update le token et la date dans la bdd avec l'email de l'utilisateur
 * @author WILLIAME Anthony
 * @param $token
 * @param $email
 */
function UpdateToken($token,$email){
    global $pdo;
    $date = date("Y-m-d H:i:s");
    $update = $pdo->prepare('UPDATE token SET token = ?,creation=? WHERE email = ?');
    $update->execute(array($token,$date,$email));
}

/**
 * On récupère le token dans la bdd avec l'email de l'utilisateur
 * @author WILLIAME Anthony
 * @param $email
 * @return array
 */
function getToken($email){
    global $pdo;
    $getToken = $pdo->prepare('SELECT * FROM token WHERE email = ?');
    $getToken->execute(array($email));
    $token = $getToken->fetch();
    return $token;
}