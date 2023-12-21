<?php
include "../../Model/Tournoi/GestionEquipeOrga.php";
/**
 * @author Gallouin Matisse
 * @param $nomEquipe
 * @param $dernierTournoi
 * permet d'ajouter une équipe et de renvoyer l'id de l'équipe à l'aide d'ajax
 */
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
echo $requeteRec->fetchAll()[0][2];

