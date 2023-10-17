<?php
require "../../Model/BDD/ConnexionBDD.php";
try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
function recupUsersNonOrga()
{
    global $pdo;
    $requete=$pdo->prepare("SELECT * FROM users where isOrganisateur=FALSE order by email");
    $requete->execute();
    $resultat=$requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['users']=$resultat;
}
function UpdateStatut($email){
    global $pdo;
    $requete=$pdo->prepare("Update users set isOrganisateur=true where email=?");
    $requete->execute(array($email));
    echo "vous avez modifié l'utilisateur ". $email;
}