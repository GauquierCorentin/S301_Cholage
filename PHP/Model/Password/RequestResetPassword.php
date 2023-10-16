<?php
session_start();
require_once '../../Model/BDD/ConnexionBDD.php';
global $pdo;

$email = $_SESSION['email'];
$token = $_SESSION['token'];

//On vérifie que l'email existe dans la base de données
$checkEmail = $pdo->prepare('SELECT * FROM users WHERE email = ?');

$checkEmail->execute([$email]);

$user = $checkEmail->fetch();

//On insère le token dans la base de données et on rajoute 5min à la date d'expiration
$pdo->prepare('UPDATE users SET reset_token = ?, 
                 reset_at = DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE email = ?')->execute([$token, $email]);

