<?php
include ("../../Model/checkSession/checkSession.php");
checkMail();
checkMailCaptain();
include ("../../Model/Tournoi/ValiderResultat.php");
$_SESSION["matchSansResult"]=getInfoMatchSansResult($_SESSION["equipe"]);

$_SESSION["matchAvecResult"]=getInfoMatchAvecResult($_SESSION["equipe"]);
include ("../../Controller/BarreMenu/BarreMenu.php");
include ("../../View/Tournoi/ValiderResultat.php");
