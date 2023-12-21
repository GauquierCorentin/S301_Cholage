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

/**
 * @param $idequipe
 * @return array|false
 * @author Gallouin Matisse
 * permet de récupérer les membres de l'équipe demandé
 */

function getMembre_Role($idequipe){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email,iscaptain from users where equipe_id=? order by iscaptain desc");
    $req->execute(array($idequipe));
    $rep=$req->fetchAll();
    return $rep;
}

/**
 * @param $idequipe
 * @return mixed
 * @author Gallouin Matisse
 * permet d'obtenir le nom d'une équipe à l'aide de son id
 */
function getNomEquipe($idequipe){
    global $pdo;
    $req=$pdo->prepare("Select nom from equipe where idequipe=? ");
    $req->execute(array($idequipe));
    $rep=$req->fetch();
    return $rep;
}

/**
 * @param $mail
 * @return mixed
 * @author Gallouin Matisse
 * permet d'obtenir l'équipe d'un joueur à l'aide de son email
 */
function getNomEquipeByMail($mail){
    global $pdo;
    $req=$pdo->prepare("Select equipe_id from users where email=? ");
    $req->execute(array($mail));
    $rep=$req->fetch();
    return getNomEquipe($rep[0]);
}

/**
 * @return array|false
 * @author Gallouin Matisse
 * permet d'obtenir les membres n'ayant pas d'équipe
 */
function getMembreSansEquipe(){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email from users where equipe_id is null and isvalidate=true");
    $req->execute();
    $rep=$req->fetchAll();
    return $rep;
}

/**
 * @param $iduser
 * @return void
 * @author Gallouin Matisse
 * permet de supprimer un user d'une équipe à l'aide de son mail
 */
function supprUser($iduser){
    global $pdo ;
    $req=$pdo->prepare("Update users set equipe_id=null,iscaptain=false where email=?");
    $req->execute(array($iduser));
    $_SESSION["equipe"]=null;
    $_SESSION["isCaptain"]=null;
}

/**
 * @param $token
 * @param $email
 * @param $idequipe
 * @return void
 * permet d'insérer dans la bdd un token crée et de lier à un user et une équipe
 */
function insertToken($token,$email,$idequipe)
{
    global $pdo;
    $date = date("Y-m-d H:i:s");
    $insertToken = $pdo->prepare('INSERT INTO token VALUES (?, ?, ?,true,?)');
    $insertToken->execute(array($token, $date,$email,$idequipe ));
}

/**
 * @param $token
 * @param $email
 * @param $idequipe
 * @return void
 * permet de mettre à jour un token existant si il possède les memes carectirestiques qu'un présent dans la BDD
 */
function UpdateToken($token,$email,$idequipe){
    global $pdo;
    $date = date("Y-m-d H:i:s");
    $update = $pdo->prepare('UPDATE token SET token = ?,creation=?,idequipe=? WHERE (email = ? and isinvitation=true and idequipe=?)');
    $update->execute(array($token,$date,$idequipe,$email,$idequipe));
}

/**
 * @param $email
 * @param $idequipe
 * @return mixed
 * permet d'obtenir le token lié à un joueur et une équipe
 */
function getToken($email,$idequipe){
    global $pdo;
    $getToken = $pdo->prepare('SELECT * FROM token WHERE email = ? and isinvitation!=false and idequipe=?');
    $getToken->execute(array($email,$idequipe));
    $token = $getToken->fetch();
    return $token;
}