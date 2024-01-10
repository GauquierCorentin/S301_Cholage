<?php
include "../../Model/checkSession/checkSession.php";
checkMail();
include "../../Model/Tournoi/ClassementTournoi.php";
$_SESSION["Tournoi"]=getAllTournoi();
include "../../View/Tournoi/ClassementTournoi.php";
