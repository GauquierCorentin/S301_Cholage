<?php
require("../../Model/checkSession/checkSession.php");
checkMailValidate();
include("../../Controller/BarreMenu/BarreMenu.php");
include("../../Model/Tournoi/afficherEquipe.php");

$tournoi = getTournoi();
$_SESSION['Tournoi'] = $tournoi;
$equipe = getEquipe();
$_SESSION['LstEquipe'] = $equipe;
$membreEquipe = getMembreEquipe();
$_SESSION['mbEquipe'] = $membreEquipe;

include("../../View/Tournoi/afficherEquipe.php");
?>