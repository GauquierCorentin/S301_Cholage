<?php
require_once ('../../Model/BDD/ConnexionBDD.php');

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