<?php

global $pdo;
$pari = $_POST['pari'];
$idmatch = $_POST['idmatch'];
$idequipe = $_POST['idequipe'];

#On regarde si l'équipe est en dechole ou chole
$req = $pdo->prepare("SELECT equipechole,equipedechole from match WHERE idmatch = ?, equipechole = ?");
$req->execute(array($idmatch, $idequipe));
$equipe = $req->fetch();

if ($equipe['equipechole'] == $idequipe) {
    $sql = $pdo->prepare("UPDATE match set (pariequipe1) VALUES (?) WHERE idmatch = ?");
} else {
    $equipe = "equipedechole";
}