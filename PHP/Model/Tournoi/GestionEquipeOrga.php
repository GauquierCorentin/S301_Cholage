<?php
include "../../Model/BDD/ConnexionBDD.php";
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
/**
 * @return array|false
 * @author Gallouin Matisse
 * permet d'obtenir tous les membres sans équipe qui sont validés
 */
function getMembreSansEquipe(){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email from users where equipe_id is null and isvalidate=true");
    $req->execute();
    $rep=$req->fetchAll();
    return $rep;
}

/**
 * @return array|false
 * @author Gallouin Matisse
 * permet de récupérer toutes les équipes
 */
function getEquipe()
{
    global $pdo;
    $req = $pdo->prepare('select * from equipe');
    $req->execute();
    return $req->fetchAll();
}

/**
 * @param $idequipe
 * @return array|false
 * @author Gallouin Matisse
 * permet de récupérer tous les joueurs d'une équipe
 */
function getMembreEquipe($idequipe){
    global $pdo;
    $req = $pdo -> prepare("select nom, prenom, equipe_id, iscaptain, email from users where equipe_id=? order by iscaptain desc ");
    $req->execute(array($idequipe));
    return $req->fetchAll();
}

/**
 * @return mixed
 * @author Gallouin Matisse
 * permet d'obtenir le dernier tournoi créé
 */
function getLastTournoi(){
    global $pdo;
    $req=$pdo->prepare("Select idtournoi from tournoi order by idtournoi desc");
    $req->execute();
    return $req->fetch();
}

