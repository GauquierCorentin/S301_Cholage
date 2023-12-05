<?php
require_once('../../Model/BDD/ConnexionBDD.php');

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

/**
 * Récupère tous les questionnaires auxquels du plus récent au moins récent
 * @param $iduser string
 * @return array
 * @author WEBER Guilhem
 */
function getQuestionnaires(string $iduser): array
{
    global $pdo;
    $req = $pdo->prepare('select * from questionnaire join public.repqestionnaire r on questionnaire.id = r.idquestionnaire where iduser = ? and rep = false order by id');
    $req->execute(array($iduser));
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
    $req = $pdo->prepare('select distinct textreponse from reponse where idquestion = ?');
    $req->execute(array($idquestion));
    return $req->fetchAll();
}


/**
 * Récupère les id des réponses liées au questionnaire passé en paramètre
 * @param int $idq id du questionnaire voulu
 * @return array
 * @author WEBER Guilhem
 */
function getReps(int $idq) {
    global $pdo;
    $req = $pdo->prepare('select distinct idreponse from reponse join public.question q on reponse.idquestion = q.idquestion where idquestionnaire = ?');
    $req->execute(array($idq));
    return $req->fetchAll();
}


/**
 * Mets à jour la table réponse selon la réponse de l'utilisateur
 * Mets à jour la table repquestionnaire pour dire que l'utilisateur a répondu au questionnaire
 * @param int $idq id du questionnaire
 * @param int $idr id de la réponse
 * @param string $idu id de l'utilisateur
 * @param bool $rep réponse de l'utilisateur
 * @return void
 * @author Weber Guilhem
 */
function repondre(int $idq, $idr, $idu, bool $rep) {
    global $pdo;
    $reqA = $pdo->prepare('update reponse set ischeckbox = ? where idreponse = ? and iduser = ?');
    $reqA->execute(array($rep, $idr, $idu));
    $reqB = $pdo->prepare('update repqestionnaire set rep = true where idquestionnaire = ? and iduser = ?');
    $reqB->execute(array($idq, $idu));
}


function getReponsesPasRepondues(int $idq, string $idu) {
    global $pdo;
    $req = $pdo->prepare('select idreponse, idquestion from reponse left join public.repqestionnaire r on reponse.iduser = r.iduser where idquestionnaire = ? and r.iduser = ? and rep = false');
    $req->execute(array($idq, $idu));
    return $req->fetchAll();
}