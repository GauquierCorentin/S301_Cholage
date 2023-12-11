<?php
session_start();
$idequipe=$_SESSION["equipe"];
include("GestionEquipe.php");

global $pdo;
error_log("fonction appelé avec succès");
$membreequipe = getMembre_Role($idequipe);
foreach ($membreequipe as $membre) {
    supprUser($membre['email']);
}
$req = $pdo->prepare("delete  from equipe where idequipe=? ");
$req->execute(array($idequipe));
$_SESSION["equipe"]=null;