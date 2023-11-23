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

function getMembreEquipe($idequipe){
    global $pdo;
    $req = $pdo -> prepare("select nom, prenom from users where equipe_id=:id;");
    $req->bindParam(':id', $idequipe);
    $req->execute();
    $l = array();
    while ($row = $req->fetch()) {
        array_push($l, $row);
    }
    return $l;
}