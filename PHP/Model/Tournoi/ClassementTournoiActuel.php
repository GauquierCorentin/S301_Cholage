<?php
include ("../../Model/BDD/ConnexionBDD.php");
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

function getScoreEquipe($idtournoi){
 global $pdo;
 $requete=$pdo->prepare("select nom,count(m.equipegagnante) as victoire,count(m2.equipeperdante) as défaite
from equipe
left join public.match m on equipe.idequipe = m.equipegagnante
left join public.match m2 on equipe.idequipe = m2.equipeperdante
where idtournoi=?
group by idequipe;");
 $requete->execute(array($idtournoi));
 return $requete->fetchAll();
}

/**
 * @return mixed
 * @author Gallouin Matisse
 * permet d'obtenir le dernier tournoi créé
 */
function getLastTournoi(){
    global $pdo;
    $req=$pdo->prepare("Select idtournoi from tournoi order by idtournoi desc");
    $req->execute();
    return $req->fetch();
}
