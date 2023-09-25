<?php
require_once '../../Model/BDD/ConnexionBDD.php';
global $pdo;
//On récupère les données de la table User

$requete = $pdo->prepare('SELECT * FROM User WHERE isValidate = false');
$requete->execute();
$usersNonValidate = $requete->fetchAll(PDO::FETCH_ASSOC);

//On modifie la valeur de isValidate à true

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $requete = $pdo->prepare('UPDATE User SET isValidate = true WHERE id = :id');
    $requete->bindParam(':id', $id);
    $requete->execute();
    header('Location: ../../View/Admin/Validation.php');
}