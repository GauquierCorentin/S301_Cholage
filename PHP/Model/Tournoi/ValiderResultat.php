<?php
include ("../../Model/BDD/ConnexionBDD.php");
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

/**
 * @param $idequipe
 * @return array|false
 * @author Gallouin Matisse
 * permet de récupérer les matchs ayant un résultat donnée
 */
function getInfoMatchAvecResult($idequipe)
{
    global $pdo;
    $req=$pdo->prepare("select idmatch,equipechole,equipedechole,pariequipe1,e.nom as nomequipe1,e2.nom as nomequipe2,valideresultat,resultatdonnee
from match
join public.equipe e on e.idequipe = match.equipechole
join public.equipe e2 on e2.idequipe = match.equipedechole
where (equipechole=? or equipedechole=?) and (pariequipe1 is not null and pariequipe2 is not null) and resultatdonnee is not null");
    $req->execute(array($idequipe,$idequipe));
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param $idequipe
 * @return array|false
 * @author Gallouin Matisse
 * récupérer les matchs sans résultat donnée
 */
function getInfoMatchSansResult($idequipe)
{
    global $pdo;
    $req=$pdo->prepare("select idmatch,equipechole,equipedechole,pariequipe1,e.nom,e2.nom
from match 
join public.equipe e on e.idequipe = match.equipechole
join public.equipe e2 on e2.idequipe = match.equipedechole
where (equipechole=? or equipedechole=?) and (pariequipe1 is not null and pariequipe2 is not null) and resultatdonnee is null");
    $req->execute(array($idequipe,$idequipe));
    return $req->fetchAll();
}

/**
 * @param $idmatch
 * @param $resultat
 * @return void
 * @author Gallouin Matisse
 * permet de changer le résultat donné pour un match
 */
function changerResultMatch($idmatch,$resultat)
{
    global $pdo;
    $req=$pdo->prepare("update match set resultatdonnee=? where idmatch=?");
    $req->execute(array($resultat,$idmatch));
}

/**
 * @param $idmatch
 * @return void
 * @author Gallouin Matisse
 * permet de refuser le résultat donné
 */
function refuserResult($idmatch)
{
    global $pdo;
    $req=$pdo->prepare("update match set valideresultat=false where idmatch=?");
    $req->execute(array($idmatch));
}

/**
 * @param $idmatch
 * @return void
 * @author Gallouin Matisse
 * permet d'accepter le résultat
 */
function accepterResult($idmatch)
{
    global $pdo;
    $req=$pdo->prepare("update match set valideresultat=true where idmatch=?");
    $req->execute(array($idmatch));
    $req=$pdo->prepare("select resultatdonnee,pariequipe1,equipechole,equipedechole from match where idmatch=?");
    $req->execute(array($idmatch));
    $result=$req->fetch();
    $req=$pdo->prepare("update match set equipegagnante=?,equipeperdante=? where idmatch=?");
    if($result[0]==$result[1] or $result[0]<$result[1]){
        $req->execute(array($result[2],$result[3],$idmatch));
    }
    else{
        $req->execute(array($result[3],$result[2],$idmatch));
    }
}