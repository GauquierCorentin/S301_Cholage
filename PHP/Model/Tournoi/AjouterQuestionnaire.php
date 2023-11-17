<?php
require_once '../../Model/BDD/ConnexionBDD.php';
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

/**
 * Fonction qui permet d'ajouter le questionnaire a la table questionnaire
 * @author WILLIAME Anthony
 * @param $nom
 * @return void
 */
function addQuestionnaire($nom){
    global $pdo;
    $req = $pdo->prepare('INSERT INTO questionnaire VALUES (default,?)');
    $req->execute(array($nom));
}

/**
 * Fonction qui permet de récupérer le dernier questionnaire ajouté dans la table questionnaire
 * @author WILLIAME Anthony
 * @return mixed
 */
function getQuestionnaire(){
    global $pdo;
    $req = $pdo->prepare('SELECT id FROM questionnaire order by id desc');
    $req->execute();
    $questionnaire = $req->fetch();
    return $questionnaire;
}

/**
 * Fonctio qui ajoute une question dans la table question et retourne l'id de la question ajoutée
 * @author WILLIAME Anthony, Gallouin Matisse
 * @param $question
 * @param $idquestionnaire
 * @return mixed
 */
function addQuestion($question,$idquestionnaire){
    global $pdo;
    $req = $pdo->prepare('INSERT INTO question VALUES (default,?,?)');
    $req->execute(array($question,$idquestionnaire));

    $idquestion = $pdo->prepare('SELECT idquestion FROM question order by idquestion desc');
    $idquestion->execute();
    $idquestions = $idquestion->fetch();
    return $idquestions[0];
}

/**
 * @author WILLIAME Anthony, GALLOUIN Matisse
 * Fonction qui ajoute une réponse dans la table reponse
 * @param $reponse
 * @param $idquestion
 * @return void
 */
function addReponse($reponse,$idquestion){
    global $pdo;
    $req = $pdo->prepare('INSERT INTO reponse VALUES (default,?,default,?)');
    $req->execute(array($reponse,$idquestion));
}