<?php
/**
 * @author Gallouin Matisse
 * @param $idjoueur
 * permet de supprimer un user à l'aide d'ajax avec des données obtenues d'ajax
 */
include ('../../Model/Tournoi/GestionEquipeOrga.php');
global $pdo;
$idjoueur=$_POST["idjoueur"];
$requete=$pdo->prepare("Update users set equipe_id=null, iscaptain=false where email=?");
$requete->execute(array($idjoueur));
