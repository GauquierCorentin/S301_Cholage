<?php
include ("../../Model/checkSession/checkSession.php");
include("../../Model/Tournoi/ClassementTournoi.php");

$_SESSION["resultEquipe"]=getScoreEquipe(getLastTournoi()[0]);
