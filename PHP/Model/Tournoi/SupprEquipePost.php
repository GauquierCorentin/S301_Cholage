<?php

session_start();
$idequipe = $_POST["idequipe"];
include("GestionEquipe.php");

global $pdo;
$membreequipe = getMembre_Role($idequipe);
foreach ($membreequipe as $membre) {
    supprUser($membre['email']);
}
$req = $pdo->prepare("delete  from equipe where idequipe=? ");
$req->execute(array($idequipe));