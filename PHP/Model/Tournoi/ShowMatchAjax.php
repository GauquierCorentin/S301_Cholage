<?php
include "../../Model/BDD/ConnexionBDD.php";
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
global $pdo;
$pari = $_POST['pari'];
$idmatch = $_POST['idmatch'];
$idequipe = $_POST['idequipe'];
echo $idmatch . "\n".$idequipe;
#On regarde si l'équipe est en dechole ou chole
$req = $pdo->prepare("SELECT equipechole,equipedechole from match WHERE idmatch = ?");
$req->execute(array($idmatch));
$equipe = $req->fetch();

if ($equipe[0]== $idequipe) {
    $sql = $pdo->prepare("UPDATE match set pariequipe1=? WHERE idmatch = ?");
    $sql->execute(array($pari, $idmatch));
} else {
    $sql = $pdo->prepare("UPDATE match set pariequipe2=? WHERE idmatch = ?");
    $sql->execute(array($pari, $idmatch));
}