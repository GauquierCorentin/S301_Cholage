<?php
require_once ("../../Model/BDD/ConnexionBDD.php");

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die('Erreur :'. $e->getMessage());
}

function getEquipe(): array
{
    global $pdo;
    $req = $pdo->prepare('select * from equipe');
    $req->execute();
    return $req->fetchAll();
}

function getMembreEquipe(){
    global $pdo;
    $req = $pdo -> prepare("select nom, prenom, equipe_id from users");
    $req->execute();
    $l = array();
    while ($row = $req->fetch()) {
        array_push($l, $row);
    }
    return $l;
}
