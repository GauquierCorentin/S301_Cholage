<?php
require_once ("../../Model/BDD/ConnexionBDD.php");
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
function rechargerSession($mail)
{
    global $pdo;
    $requete=$pdo->prepare("Select * from users where email=?");
    $requete->execute(array($mail));
    $row=$requete->fetch(PDO::FETCH_ASSOC);
    $_SESSION['mail']=$mail;
    $_SESSION['isValidate']=$row["isvalidate"];
    $_SESSION['isCaptain']=$row["iscaptain"];
    $_SESSION['equipe']=$row["equipe_id"];
    $_SESSION['isorganisateur']=$row['isorganisateur'];
    $_SESSION['isadmin']=$row['isadmin'];
    $_SESSION['fullname']= $row['nom'] . ' ' . $row['prenom'];
}
