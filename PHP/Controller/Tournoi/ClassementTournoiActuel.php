<?php
include ("../../Model/checkSession/checkSession.php");
include ("../../Model/Tournoi/ClassementTournoiActuel.php");

$_SESSION["resultEquipe"]=getScoreEquipe(getLastTournoi()[0]);
