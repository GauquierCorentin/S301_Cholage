<?php
ob_start();
include ("../../Model/checkSession/checkSession.php");
include("../../Model/Tournoi/ShowMatch.php");
checkMailValidate();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$equipe = $_SESSION['equipe'];
$idtournoi = getLastTournoi()['idtournoi'];
$matchs = getMatchs($equipe, $idtournoi);
$arrayMatchs = array();
$arrayNomEquipe = array();
$arrayIdMatch = array();

foreach ($matchs as $match){
    $match = array($match['idmatch']);
    array_push($arrayIdMatch, $match);
}
$_SESSION['matchId'] = $arrayIdMatch;

foreach ($matchs as $match){
    $match = array($match['equipechole'], $match['equipedechole']);
    array_push($arrayMatchs, $match);
}
$_SESSION['idMatchs'] = $arrayMatchs;

foreach ($arrayMatchs as $match){
    $nomEquipe = getNomEquipe($match[0], $idtournoi)[0]['nom'];
    array_push($arrayNomEquipe, $nomEquipe);
}
$_SESSION['matchs'] = $arrayNomEquipe;

include("../../View/Tournoi/ShowMatch.php");
?>