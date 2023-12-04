<?php
require("../../Model/checkSession/checkSession.php");
checkMailValidate();
include("../../View/BarreMenu/BarreMenu.php");
include("../../Model/Tournoi/afficherEquipe.php");


$equipe = getEquipe();
$_SESSION['LstEquipe'] = $equipe;
$membreEquipe = getMembreEquipe();
$_SESSION['mbEquipe'] = $membreEquipe;

include("../../View/Tournoi/afficherEquipe.php");
?>