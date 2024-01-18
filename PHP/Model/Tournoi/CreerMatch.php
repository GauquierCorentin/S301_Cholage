<?php
include "../../Model/BDD/ConnexionBDD.php";
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
/**
 * @param $listecompetiteurs
 * @author Gallouin Matisse
 * @return array
 * permet de créer une liste de match de façon à ce que toutes les équipes s'affrontent entre elles en utilisant la méthode du ruban
 */
function genererMatch($listecompetiteurs) {
    $couleur=true;
    $lstmatch=[];
    //ajout d'une équipe fantome pour avoir une liste pair et permettre à l'algo de fonctionner comme il faut
    if(sizeof($listecompetiteurs)){
        array_push($listecompetiteurs,0);
    }
    $copie=$listecompetiteurs;
    for ($i=0;$i<sizeof($listecompetiteurs)-1;$i++) {
        //création des listes permettants la répartition des équipes
        $listeblanc = [];
        $listenoire = [];
        //gestion des premiers et derniers conformément à la méthode du ruban
        if ($couleur == true) {
            array_push($listeblanc, $copie[0]);
            array_push($listenoire, $copie[sizeof($copie) - 1]);
            $couleur = false;
        } else {
            array_push($listenoire, $copie[0]);
            array_push($listeblanc, $copie[sizeof($copie) - 1]);
            $couleur = true;
        }
        //ajout des valeurs dans les deux listes
        for ($j = 1; $j < sizeof($copie) - 1; $j++) {
            if (($j + 1) % 2 == 0) {
                array_push($listenoire, $copie[$j]);
            } else {
                array_push($listeblanc, $copie[sizeof($copie) - $j]);
            }
        }
        //ajout des matchs dans la matrice des matchs
        for ($j = 0; $j < sizeof($listeblanc); $j++) {
            array_push($lstmatch, [$listeblanc[$j], $listenoire[$j]]);
        }
        //décalage de la liste des équipes dans le cycle horaire
        $copie2 = $copie;
        $mem = $copie[sizeof($copie) - 1];
        for ($j = 0; $j < sizeof($listecompetiteurs); $j++) {
            if ($j != 0) {
                $copie[$j] = $copie2[$j - 1];
            }
        }
        $copie[1] = $mem;

    }
    return $lstmatch;
}

/**
 * @param $idtournoi
 * @return array|false
 * @author Gallouin Matisse
 * permet d'obtenir tous les matchs d'un tournoi
 */
function getAllMatchTournoi($idtournoi)
{
    global $pdo;
    $req=$pdo->prepare("select idmatch,e.nom,e2.nom,heure
from match
join public.equipe e on e.idequipe = match.equipechole
join public.equipe e2 on e2.idequipe = match.equipedechole
where match.idtournoi=? ");
    $req->execute(array($idtournoi));
    return $req->fetchAll();
}
/**
 * @author Gallouin Matisse
 * fonction permettant d'aller chercher le dernier id de tournoi
 * @return mixed
 */
function getLastTournoi(){
    global $pdo;
    $req=$pdo->prepare("Select idtournoi from tournoi order by idtournoi desc");
    $req->execute();
    return $req->fetch();
}

/**
 * @param $idtournoi
 * @param $equipe1
 * @param $equipe2
 * @return void
 * @author Gallouin Matisse
 * permet d'ajouter un match dans la BDD
 */
function addMatch($idtournoi,$equipe1,$equipe2){
    global $pdo;
    $req=$pdo->prepare("insert into match values (default,null,null,null,null,null,?,?,?,null,null,null,null)");
    $req->execute(array($idtournoi,$equipe1,$equipe2));
}

/**
 * @param $idtournoi
 * @return array|false
 * @author Gallouin Matisse
 * permet d'obtenir toutes les équipes participant à un tournoi
 */
function getAllEquipeTournoi($idtournoi){
    global $pdo;
    $req=$pdo->prepare("select idequipe from equipe where idtournoi=?");
    $req->execute(array($idtournoi));
    return $req->fetchAll();
}

/**
 * @param $idtournoi
 * @return void
 * @author Gallouin Matisse
 * permet de supprimer tous les matchs d'un tournoi
 */
function supprMatchTournoi($idtournoi){
    global $pdo;
    $req=$pdo->prepare("delete from match where $idtournoi=?");
    $req->execute(array($idtournoi));
}

/**
 * @param $idmatch
 * @param $heure
 * @return void
 * permet de changer l'heure d'un match
 * @author Gallouin Matisse
 */
function changerHeure($idmatch,$heure)
{
    global $pdo;
    $req=$pdo->prepare("update match set heure=? where idmatch=?");
    $req->execute(array($heure,$idmatch));

}