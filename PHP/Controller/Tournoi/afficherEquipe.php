<?php
include("../../View/BarreMenu/BarreMenu.php");
include("../../Model/Tournoi/afficherEquipe.php");


$equipe = getEquipe();
$_SESSION['equipe'] = $equipe;
$membreEquipe = getMembreEquipe();
$_SESSION['mbEquipe'] = $membreEquipe;
include("../../View/Tournoi/afficherEquipe.php");