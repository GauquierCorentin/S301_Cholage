<?php
include "ClassementTournoi.php";

$idtournoi=$_POST["idtournoi"];

foreach (getScoreEquipe($idtournoi) as $result){
    echo "/".$result[0]." ".$result[1]." ".$result[2];
}
