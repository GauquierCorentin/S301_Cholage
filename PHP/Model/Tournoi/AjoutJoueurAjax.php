<?php
include ('../../Model/Tournoi/GestionEquipeOrga.php');
global $pdo;
$idequipe=$_POST["idequipe"];
$idjoueur=$_POST["idjoueur"];
$requete=$pdo->prepare("Update users set equipe_id=? where email=?");
$requete->execute(array($idequipe,$idjoueur));

