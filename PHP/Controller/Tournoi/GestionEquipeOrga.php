<?php
include ("../../Model/checkSession/checkSession.php");
include ("../../Model/Tournoi/GestionEquipeOrga.php");
$_SESSION["lstEquipes"]=getEquipe();
foreach ($_SESSION["lstEquipes"] as $equipe){
    $_SESSION["membreEquipe".$equipe[0]]=getMembreEquipe($equipe[2]);
}
$_SESSION["membreSansEquipe"]=getMembreSansEquipe();
include "../../View/Tournoi/GestionEquipeOrga.php";