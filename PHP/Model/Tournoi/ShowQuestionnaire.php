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
    $req = $pdo->prepare('select * from reponse where idquestion = ?');
    $req->execute(array($idquestion));
    return $req->fetchAll();
}

/**
 * Ajoute un contenu à la réponse passée en paramètre pour l'utilisateur passé en paramètre
 * @param int $idrep id de la réponse à éditer
 * @param mixed $rep boolean ou string dépendant du type de réponse
 * @param string $iduser id de l'utilisateur courant
 * @return void
 * @author WEBER Guilhem
 */
function addRep(int $idrep, mixed $rep, string $iduser) {
    global $pdo;
    if (gettype($rep) == "string") {
        $req = $pdo->prepare('update reponse set textreponse = ? where idreponse = ? and iduser = ?');
    } else {
        $req = $pdo->prepare('update reponse set ischeckbox = ? where idreponse = ? and iduser = ?');
    }
    $req->execute(array($rep, $idrep, $iduser));
}


/**
 * Récupère les id des réponses liées au questionnaire passé en paramètre
 * @param int $idq id du questionnaire voulu
 * @return array
 * @author WEBER Guilhem
 */
function getReps(int $idq) {
    global $pdo;
    $req = $pdo->prepare('select idreponse from reponse join public.question q on reponse.idquestion = q.idquestion where idquestionnaire = ?');
    $req->execute(array($idq));
    return $req->fetchAll();
}
