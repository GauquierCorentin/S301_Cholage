<?php
include "../../Model/BDD/ConnexionBDD.php";
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
function genererMatch($listecompetiteurs) {
    $couleur=true;
    $lstmatch=[];
    if(sizeof($listecompetiteurs)){
        array_push($listecompetiteurs,0);
    }
    $copie=$listecompetiteurs;
    for ($i=0;$i<sizeof($listecompetiteurs)-1;$i++) {
        $listeblanc = [];
        $listenoire = [];
        if ($couleur == true) {
            array_push($listeblanc, $copie[0]);
            array_push($listenoire, $copie[sizeof($copie) - 1]);
            $couleur = false;
        } else {
            array_push($listenoire, $copie[0]);
            array_push($listeblanc, $copie[sizeof($copie) - 1]);
            $couleur = true;
        }
        for ($j = 1; $j < sizeof($copie) - 1; $j++) {
            if (($j + 1) % 2 == 0) {
                array_push($listenoire, $copie[$j]);
            } else {
                array_push($listeblanc, $copie[sizeof($copie) - $j]);
            }
        }

        for ($j = 0; $j < sizeof($listeblanc); $j++) {
            array_push($lstmatch, [$listeblanc[$j], $listenoire[$j]]);
        }
        $copie2 = $copie;
        $mem = $copie[sizeof($copie) - 1];
        for ($j = 0; $j < sizeof($listecompetiteurs); $j++) {
            if ($j != 0) {
                $copie[$j] = $copie2[$j - 1];
            }
        }
        $copie[1] = $mem;


        echo "<br></br>listeblanc<br>";
        foreach ($listeblanc as $item) {
            echo $item . "  ";
        }
        echo "<br>listenoire<br>";
        foreach ($listenoire as $item) {
            echo $item . "  ";
        }
        echo "<br>liste ronde<br>";
        foreach ($copie as $item) {
            echo $item . "  ";
        }
    }
}
function getAllMatchTournoi($idtournoi)
{
    global $pdo;
    $req=$pdo->prepare("select e.nom,e2.nom,heure
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
