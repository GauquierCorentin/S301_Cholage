<?php
include "../../Model/Tournoi/GestionEquipeOrga.php";
global $pdo;
$nomEquipe=$_POST["nomEquipe"];
$dernierTournoi=getLastTournoi()[0];
try {
    $requete = $pdo->prepare("Insert into equipe values (?,?,default)");
    $requete->execute(array($nomEquipe,$dernierTournoi ));
}catch(PDOException){

}
$requeteRec=$pdo->prepare("Select * from equipe where nom=? and idtournoi=?");
$requeteRec->execute(array($nomEquipe,$dernierTournoi));
return $requete->fetchAll()[0];

