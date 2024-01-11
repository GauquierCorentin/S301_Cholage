<?php
/**
 * @author Gallouin Matisse
 * @param $idjoueur
 * permet de retirer le role capitaine à un joueur à l'aide de données obtenues dans ajax
 */
include "../../Model/Tournoi/GestionEquipeOrga.php";
$idjoueur=$_POST["idjoueur"];
global $pdo;
$requete=$pdo->prepare("Update users set iscaptain=false where email=?");
$requete->execute(array($idjoueur));


