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
function getReps(int $idq)
{
    global $pdo;
    $req = $pdo->prepare('select distinct idreponse from reponse join public.question q on reponse.idquestion = q.idquestion where idquestionnaire = ?');
    $req->execute(array($idq));
    return $req->fetchAll();
}


/**
 * Mets à jour la table réponse selon la réponse de l'utilisateur
 * Mets à jour la table repquestionnaire pour dire que l'utilisateur a répondu au questionnaire
 * @param $idrep int id de la réponse
 * @param $idu string id (email) de l'utilisateur
 * @param $rep bool réponse de l'utilisateur dans le cas d'une checkbox
 * @param $textrep string réponse de l'utilisateur dans le cas d'une question ouverte
 * @return void
 * @author Weber Guilhem
 */
function repondre(int $idrep, string $idu, bool $rep, string $textrep)
{
    global $pdo;
    $reqA = $pdo->prepare('update repquestion set repondue = true, texterep = ?, rep = ? where idrep = ? and iduser = ?');
    $reqA->execute(array($textrep, $rep, $idrep, $idu));
}


/**
 * Mets à jour la table repquestionnaire pour dire que l'utilisateur a répondu au questionnaire
 * @param $idq int id du questionnaire
 * @param $idu string id (email) de l'utilisateur
 * @return void
 * @author Weber Guilhem
 */
function validerQuestionnaire(int $idq, string $idu)
{
    global $pdo;
    $req = $pdo->prepare('update repqestionnaire set rep = true where idquestionnaire = ? and iduser = ?');
    $req->execute(array($idq, $idu));
}


/**
 * Récupère l'id des réponses non validées par l'utilisateur
 * @param $idu string id (email) de l'utilisateur
 * @param $idq int id du questionnaire
 * @return array
 * @author Weber Guilhem
 */
function getReponsesPasRepondues(string $idu, int $idq)
{
    global $pdo;
    $req = $pdo->prepare('select idrep from repquestion join public.repqestionnaire r on repquestion.iduser = r.iduser where repquestion.iduser = ? and idquestionnaire = ? and repondue = false order by idrep');
    $req->execute(array($idu));
    return $req->fetchAll();
}