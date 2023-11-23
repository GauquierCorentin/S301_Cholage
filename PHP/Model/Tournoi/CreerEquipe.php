<?php
require_once ("../../Model/BDD/ConnexionBDD.php");
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
/**
 * @author Gallouin Matisse
 * @param $user string
 * @param $nom string
 * @param $idtournoi int
 * @return void
 */
function addEquipe($user,$nom/*,$idtournoi*/){
    global $pdo;
    $req=$pdo->prepare("insert into equipe values (default,?/*,?*/)");
    $req->execute(array($nom/*,$idtournoi*/));
    $req=$pdo->prepare("Select * from equipe where nom=? order by idequipe desc");
    $req->execute(array($nom));
    $idequipe=$req->fetch();
    $_SESSION["equipe"]=$idequipe[0];
    $_SESSION["isCaptain"]=true;
    $req=$pdo->prepare("update users set equipe_id=?,iscaptain=true where email=?");
    $req->execute(array($idequipe[0],$user));
    
}

/**
 * @author Gallouin Matisse
 * fonction permettant d'aller chercher le dernier id de tournoi
 * @return int
 */
function gettournoi(){
    global $pdo;
    $req=$pdo->prepare("Select idtournoi from tournoi order by idtournoi desc");
    $req->execute();
    return $req->fetch();
}
