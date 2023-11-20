<?php
require_once ("../../Model/BDD/ConnexionBDD.php");
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
function addEquipe($user,$nom/*,$idtournoi*/){
    global $pdo;
    $req=$pdo->prepare("insert into equipe values (default,?/*,?*/)");
    $req->execute(array($nom/*,$idtournoi*/));
    $req=$pdo->prepare("Select * from equipe where nom=? order by idequipe desc");
    $req->execute(array($nom));
    $idequipe=$req->fetch();
    $req=$pdo->prepare("update users set equipe_id=? where email=?");
    $req->execute(array($idequipe[0],$user));
    
}
function gettournoi(){
    global $pdo;
    $req=$pdo->prepare("Select idtournoi from tournoi order by idtournoi desc");
    $req->execute();
    return $req->fetch();
}