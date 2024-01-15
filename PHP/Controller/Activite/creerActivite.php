<?php
require("../../Model/checkSession/checkSession.php");
checkMailOrgaOrAdmin();
require("../../View/Activite/creerActivite.php");

include("../../Model/checkSession/checkSession.php");
checkMailAdmin();
checkMailOrga();
include("../../Model/Activite/creerActivite.php");
require_once '../../View/Activite/creerActivite.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);

if (isset($_POST['envoyer'])){
    #On récupère l'année grâce au $_POST['date']
    $date = $_POST['date'];
    $annee = substr($date,0,4);;
    insertTournoi($_POST['nom'],$date,$annee);
}

?>