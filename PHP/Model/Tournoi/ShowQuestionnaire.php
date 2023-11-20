<?php
require_once("../../Model/Tournoi/ShowQuestionnaire.php");
require_once("../../View/Tournoi/ShowQuestionnaire.php");
require_once("../../View/BarreMenu/BarreMenu.php");
require_once '../../Model/BDD/ConnexionBDD.php';


try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

function getQuesitionnaires() {
    global $pdo;
    $req = $pdo->prepare('select * from questionnaire order by id');
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

function getReponses($id){
    global $pdo;
    $id = (int) $id;
    echo($id . gettype($id));
    $req = $pdo->prepare('select * from reponse where idquestion = ($1)');
    echo(2);
    $req->execute($id);
    echo(3);
    $rep = $req->fetchAll();
    return $rep;
}
