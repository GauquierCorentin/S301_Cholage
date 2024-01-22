<?php

/**
 * @author Gallouin Matisse
 * permet de récupérer les résultats des équipes en fonction du tournoi avec ajax
 */
include "ClassementTournoi.php";

$idtournoi=$_POST["idtournoi"];
$i=1;

foreach (getScoreEquipe($idtournoi) as $result){
    echo $i.":;!".$result[0].":;!".$result[1].":;!".$result[2]."/";
    $i++;
}
