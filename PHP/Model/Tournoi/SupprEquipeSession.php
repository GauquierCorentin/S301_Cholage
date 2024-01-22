<?php
session_start();
/**
 * @author  Gallouin Matisse
 * @param $idequipe
 * permet de supprimer une équipe avec des joueurs dedans avec des données obtenues à l'aide d'une session
 */
$idequipe=$_SESSION["equipe"];
include("GestionEquipe.php");

global $pdo;
error_log("fonction appelé avec succès");
$membreequipe = getMembre_Role($idequipe);
foreach ($membreequipe as $membre) {
    supprUser($membre['email']);
}
$req = $pdo->prepare("delete  from token where idequipe=? ");
$req->execute(array($idequipe));
$req = $pdo->prepare("delete  from equipe where idequipe=? ");
$req->execute(array($idequipe));
$_SESSION["equipe"]=null;