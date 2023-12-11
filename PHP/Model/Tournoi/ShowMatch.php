<?php
require_once ("../../Model/BDD/ConnexionBDD.php");
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

/**
 * Fonction qui renvoie le dernier tournoi créé
 */
function getLastTournoi(){
    global $pdo;
    $req=$pdo->prepare("Select idtournoi from tournoi order by idtournoi desc");
    $req->execute();
    return $req->fetch();
}


/**
 * Fonction qui renvoie tous les matchs non fait du tournoi en cours
 * @param int $idEquipe
 * @param int $idtournoi
 * @return array
 */

function getMatchs(int $idEquipe, int $idtournoi){
    global $pdo;
    $req=$pdo->prepare("SELECT * from match WHERE (equipechole = ? or equipedechole = ?) and idtournoi = ?");
    $req->execute(array($idEquipe,$idEquipe, $idtournoi));
    return $req->fetchAll();
}

function getNomEquipe(int $idEquipe, int $idtournoi){
    global $pdo;
    $req=$pdo->prepare("Select nom from equipe where idequipe = ? and idtournoi = ?");
    $req->execute(array($idEquipe,$idtournoi));
    return $req->fetchAll();
}
?>