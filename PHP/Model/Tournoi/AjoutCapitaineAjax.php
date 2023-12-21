<?php
include "../../Model/Tournoi/GestionEquipeOrga.php";
$idjoueur=$_POST["idjoueur"];
global $pdo;
$requete=$pdo->prepare("Update users set iscaptain=true where email=?");
$requete->execute(array($idjoueur));

