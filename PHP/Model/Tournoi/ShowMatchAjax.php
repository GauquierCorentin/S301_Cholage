<?php

global $pdo;
$pari = $_POST['pari'];
$idmatch = $_POST['idmatch'];
$idequipe = $_POST['idequipe'];

#On regarde si l'équipe est en dechole ou chole
$req = $pdo->prepare("SELECT equipechole,equipedechole from match WHERE idmatch = ? and equipechole = ?");
$req->execute(array($idmatch, $idequipe));
$equipe = $req->fetch();

if ($equipe['equipechole'] == $idequipe) {
    $sql = $pdo->prepare("UPDATE match set (pariequipe1) VALUES (?) WHERE idmatch = ?");
    $sql->execute(array($pari, $idmatch));
} else {
    $sql = $pdo->prepare("UPDATE match set (pariequipe2) VALUES (?) WHERE idmatch = ?");
    $sql->execute(array($pari, $idmatch));
}