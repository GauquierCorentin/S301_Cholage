<?php
include "../../Model/checkSession/checkSession.php";
checkMail();
session_start();
include "../../Model/Tournoi/ClassementTournoi.php";
$_SESSION["Tournoi"]=getAllTournoi();
include "../../View/Tournoi/ClassementTournoi.php";
