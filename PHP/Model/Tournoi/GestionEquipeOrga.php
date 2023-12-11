<?php
include "../../Model/BDD/ConnexionBDD.php";
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

function getMembreSansEquipe(){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email from users where equipe_id is null");
    $req->execute();
    $rep=$req->fetchAll();
    return $rep;
}

function getEquipe()
{
    global $pdo;
    $req = $pdo->prepare('select * from equipe');
    $req->execute();
    return $req->fetchAll();
}

function getMembreEquipe($idequipe){
    global $pdo;
    $req = $pdo -> prepare("select nom, prenom, equipe_id, iscaptain, email from users where equipe_id=? order by iscaptain desc ");
    $req->execute(array($idequipe));
    return $req->fetchAll();
}
