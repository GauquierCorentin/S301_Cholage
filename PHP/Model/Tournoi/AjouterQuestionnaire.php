<?php
require_once '../../Model/BDD/ConnexionBDD.php';
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
function addQuestionnaire($nom){
    global $pdo;
    $req = $pdo->prepare('INSERT INTO questionnaire VALUES (default,?)');
    $req->execute(array($nom));
}

function getQuestionnaire(){
    global $pdo;
    $req = $pdo->prepare('SELECT id FROM questionnaire order by id desc');
    $req->execute();
    $questionnaire = $req->fetch();
    return $questionnaire;
}
function addQuestion($question,$idquestionnaire){
    global $pdo;
    $req = $pdo->prepare('INSERT INTO question VALUES (default,?,?)');
    $req->execute(array($question,$idquestionnaire));
}

function addReponse($reponse){
    global $pdo;
    $req = $pdo->prepare('INSERT INTO reponse VALUES (default,?)');
    $req->execute(array($reponse));
}