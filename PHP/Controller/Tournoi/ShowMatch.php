<?php
ob_start();
include ("../../Model/checkSession/checkSession.php");
include("../../Model/Tournoi/ShowMatch.php");
checkMailValidate();
include("../../View/Tournoi/ShowMatch.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);

$equipe = $_SESSION['equipe'];
$idtournoi = getLastTournoi()['idtournoi'];
$matchs = getMatchs($equipe, $idtournoi);

$_SESSION['matchs'] = $matchs;
?>