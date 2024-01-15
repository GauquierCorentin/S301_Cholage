<?php
require_once ('../../Model/BDD/ConnexionBDD.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

function insertTournoi($nom,$date,$annee){
    global $pdo;
    $req = $pdo->prepare('insert into tournoi values (default,?,?,?)');
    $req->execute(array($annee,$date,$nom));
}