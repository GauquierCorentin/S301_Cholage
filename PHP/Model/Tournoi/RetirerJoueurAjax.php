<?php
include ('../../Model/Tournoi/GestionEquipeOrga.php');
global $pdo;
$idjoueur=$_POST["idjoueur"];
$requete=$pdo->prepare("Update users set equipe_id=null where email=?");
$requete->execute(array($idjoueur));
