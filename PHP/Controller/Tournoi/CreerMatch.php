<?php
include "../../Model/checkSession/checkSession.php";
checkMail();
checkMailOrga();
include "../../Model/Tournoi/CreerMatch.php";
$_SESSION["allMatch"]=getAllMatchTournoi(getLastTournoi()[0]);
include "../../Controller/BarreMenu/BarreMenu.php";
include "../../View/Tournoi/CreerMatch.php";
