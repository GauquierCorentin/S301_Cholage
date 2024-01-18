<?php
include ("../../Model/BDD/ConnexionBDD.php");
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

/**
 * @param $idtournoi
 * @return array|false
 * @author Gallouin Matisse
 * permet de récupérer les scores des équipes d'un tournoi
 */
function getScoreEquipe($idtournoi){
 global $pdo;
 $requete=$pdo->prepare("select nom,count(m.equipegagnante) as victoire,count(m2.equipeperdante) as défaite
from equipe
left join public.match m on equipe.idequipe = m.equipegagnante
left join public.match m2 on equipe.idequipe = m2.equipeperdante
where equipe.idtournoi=?
group by idequipe
order by victoire desc ;");
 $requete->execute(array($idtournoi));
 return $requete->fetchAll();
}

/**
 * @return mixed
 * @author Gallouin Matisse
 * permet d'obtenir tous les tournois créés
 */
function getAllTournoi(){
    global $pdo;
    $req=$pdo->prepare("Select idtournoi,nomtournoi,datetournoi from tournoi order by datetournoi desc");
    $req->execute();
    return $req->fetchAll();
}


