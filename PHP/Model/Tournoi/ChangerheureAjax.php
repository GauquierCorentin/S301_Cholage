<?php
/**
 * @author Gallouin Matisse
 * permet de lancer la fonction pour changer l'heure en ajax
 */
include ("CreerMatch.php");
$heure=$_POST["heure"];
$idmatch=$_POST["idmatch"];
changerHeure($idmatch,$heure);
