<?php
require_once ('../../Model/BDD/ConnexionBDD.php');

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

function getQuesitionnaires() {
    global $pdo;
    $req = $pdo->prepare('select * from questionnaire ');
    $req->execute();
    $rep = $req->fetchAll();
    return $rep;
}

function getQuestions(){
    global $pdo;
    $req = $pdo->prepare('select * from question order by idquestionnaire');
    $req->execute();
    $rep = $req->fetchAll();
    return $rep;
}

function getRep($idquestion){
    global $pdo;
    $req = $pdo->prepare('select * from reponse where idquestion = ?');
    $req->execute(array($idquestion));
    $rep = $req->fetchAll();
    return $rep;
}
