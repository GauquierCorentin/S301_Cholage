<?php
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}


function getMembre_Role($idequipe){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email,iscaptain from users where equipe_id=?");
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
function getMembreSansEquipe(){
    global $pdo;
    $req=$pdo->prepare("Select nom,prenom,email from users where equipe_id=null");
    $req->execute();
    $rep=$req->fetchAll();
    return $rep;
}
function supprUser($iduser){
    global $pdo ;
    $req=$pdo->prepare("Update users set equipe_id=null,iscaptain=false where email=?");
    $req->execute(array($iduser));
}
function supprEquipe($idequipe){
    global $pdo;
    $membreequipe=getMembre_Role($idequipe);
    foreach ($membreequipe as $membre) {
        supprUser($membre['email']);
    }
    $req=$pdo->prepare("delete * from users where idequipe=? ");
    $req->execute(array($idequipe));
}