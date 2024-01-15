<?php
include "../../Model/checkSession/checkSession.php";
checkMail();
include "../../Model/Tournoi/ClassementTournoi.php";
$_SESSION["Tournoi"]=getAllTournoi();

include("../../Controller/BarreMenu/BarreMenu.php");

include "../../View/Tournoi/ClassementTournoi.php";
