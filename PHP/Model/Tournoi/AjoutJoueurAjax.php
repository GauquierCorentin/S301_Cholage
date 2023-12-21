<?php
include ('../../Model/Tournoi/GestionEquipeOrga.php');
/**
 * @author Gallouin Matisse
 * @param $idjoueur
 * @param $idequipe
 * permet d'ajouter un joueur à une équipe à l'aide d'ajax
 */
global $pdo;
$idequipe=$_POST["idequipe"];
$idjoueur=$_POST["idjoueur"];
$requete=$pdo->prepare("Update users set equipe_id=? where email=?");
$requete->execute(array($idequipe,$idjoueur));

