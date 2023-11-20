<?php
require_once('../../Model/BDD/ConnexionBDD.php');

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

/**
 * Fonction récupère tous les questionnaires existant du plus récent au moins récent
 * @return array
 * @author WEBER Guilhem
 */
function getQuesitionnaires(): array
{
    global $pdo;
    $req = $pdo->prepare('select * from questionnaire ');
    $req->execute();
    return $req->fetchAll();
}


/**
 * Permet de récupérer toutes le questions existantes, triée par rapport à leur questionnaire associé du pus récent au moins récent
 * @return array
 * @author WEBER Guilhem
 */
function getQuestions(): array
{
    global $pdo;
    $req = $pdo->prepare('select * from question order by idquestionnaire');
    $req->execute();
    return $req->fetchAll();
}


/**
 * Fonction récupère les réponses disponibles associée à l'idQuestion associé
 * @param $idquestion int
 * @return array
 * @author WEBER Guilhem
 */
function getRep(int $idquestion): array
{
    global $pdo;
    $req = $pdo->prepare('select * from reponse where idquestion = ?');
    $req->execute(array($idquestion));
    return $req->fetchAll();
}
