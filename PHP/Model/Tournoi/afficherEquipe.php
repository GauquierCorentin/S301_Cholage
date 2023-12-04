<?php
require_once ("../../Model/BDD/ConnexionBDD.php");

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die('Erreur :'. $e->getMessage());
}
/**
 * Fonction récuperant l'ensemble de la table equipe
 * @return array
 * @author GUERIN jean-baptiste
 */
function getEquipe(): array
{
    global $pdo;
    $req = $pdo->prepare('select * from equipe');
    $req->execute();
    return $req->fetchAll();
}
/**
 * Fonction récuperant les membres avec l'id d'equipe associé
 * @return array
 * @author GUERIN jean-baptiste
 */
function getMembreEquipe(){
    global $pdo;
    $req = $pdo -> prepare("select nom, prenom, equipe_id, iscaptain, email from users order by iscaptain desc ");
    $req->execute();
    $l = array();
    while ($row = $req->fetch()) {
        array_push($l, $row);
    }
    return $l;
}
