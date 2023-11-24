<?php
include("../../View/BarreMenu/BarreMenu.php");
include("../../View/Tournoi/afficherEquipe.php");
include("../../Model/Tournoi/afficherEquipe.php");

$equipe = getEquipe();
$_SESSION['equipes'] = $equipe;
$membreEquipe = getMembreEquipe();
$_SESSION['mbEquipe'] = $membreEquipe;
