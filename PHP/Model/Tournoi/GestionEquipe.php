<?php
include ("../../Model/BDD/ConnexionBDD.php");


try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
ob_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

function getMembre_Role($idequipe){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email,iscaptain from users where equipe_id=? order by iscaptain desc");
    $req->execute(array($idequipe));
    $rep=$req->fetchAll();
    return $rep;
}
function getNomEquipe($idequipe){
    global $pdo;
    $req=$pdo->prepare("Select nom from equipe where idequipe=? ");
    $req->execute(array($idequipe));
    $rep=$req->fetch();
    return $rep;
}
function getNomEquipeByMail($mail){
    global $pdo;
    $req=$pdo->prepare("Select equipe_id from users where email=? ");
    $req->execute(array($mail));
    $rep=$req->fetch();
    return getNomEquipe($rep[0]);
}
function getMembreSansEquipe(){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email from users where equipe_id is null");
    $req->execute();
    $rep=$req->fetchAll();
    return $rep;
}
function supprUser($iduser){
    global $pdo ;
    $req=$pdo->prepare("Update users set equipe_id=null,iscaptain=false where email=?");
    $req->execute(array($iduser));
    $_SESSION["equipe"]=null;
    $_SESSION["isCaptain"]=null;
}
function verifequipe($iduser){
    global $pdo;
    $req=$pdo->prepare("Select equipe_id from users where email=?");
    $req->execute(array($iduser));
    return $req->fetch();
}
function insertToken($token,$email,$idequipe)
{
    global $pdo;
    $date = date("Y-m-d H:i:s");
    $insertToken = $pdo->prepare('INSERT INTO token VALUES (?, ?, ?,true,?)');
    $insertToken->execute(array($token, $date,$email,$idequipe ));
}
function UpdateToken($token,$email,$idequipe){
    global $pdo;
    $date = date("Y-m-d H:i:s");
    $update = $pdo->prepare('UPDATE token SET token = ?,creation=?,idequipe=? WHERE (email = ? and isinvitation=true and idequipe=?)');
    $update->execute(array($token,$date,$idequipe,$email,$idequipe));
}
function getToken($email,$idequipe){
    global $pdo;
    $getToken = $pdo->prepare('SELECT * FROM token WHERE email = ? and isinvitation!=false and idequipe=?');
    $getToken->execute(array($email,$idequipe));
    $token = $getToken->fetch();
    return $token;
}