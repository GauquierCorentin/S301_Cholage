<?php
ob_start();
include ("../../Model/checkSession/checkSession.php");
include("../../Model/Tournoi/ShowMatch.php");
checkMailValidate();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$idequipe = $_SESSION['equipe'];
$idtournoi = getLastTournoi();
$idtournoi = $idtournoi[0];
$matchs = getMatchs($idequipe, $idtournoi);
$_SESSION['matchs'] = $matchs;
$nomEquipeAdverse= array();
$_SESSION['nomEquipe']= getNomEquipeMatch($idequipe);
$idmatch = array();
foreach ($matchs as $match){
    if ($idequipe==$match[0]) {
        array_push($nomEquipeAdverse, getNomEquipeMatch($match[1]));
    }
    else{
        array_push($nomEquipeAdverse,getNomEquipeMatch($match[0]));
    }
    array_push($idmatch, $match[2]);
}
$_SESSION['nomEquipeAdverse'] = $nomEquipeAdverse;
$_SESSION['idmatch'] = $idmatch;

include "../../Controller/BarreMenu/BarreMenu.php";
include("../../View/Tournoi/ShowMatch.php");

?>