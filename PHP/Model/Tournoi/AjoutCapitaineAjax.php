<?php
include "../../Model/Tournoi/GestionEquipeOrga.php";
/**
 * @author Gallouin Matisse
 * @param $idjoueur
 * permet d'ajouter le role capitaine à un joueur à l'aide d'ajax
 */
$idjoueur=$_POST["idjoueur"];
global $pdo;
$requete=$pdo->prepare("Update users set iscaptain=true where email=?");
$requete->execute(array($idjoueur));

