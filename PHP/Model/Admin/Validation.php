<?php
require_once '../../Model/BDD/ConnexionBDD.php';
//On récupère les données de la table User
error_reporting(E_ALL);
ini_set("display_errors", 1);

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}
//Requetes pour récupérer tout les users
function getusers()
{
    global $pdo;
    $requete = $pdo->prepare('SELECT * FROM users order by email');
    $requete->execute();
    $users = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}
//On regarde la date de validation de chaque user
function setDateValidation()
{
    global $pdo;
    $users=getusers();
    foreach ($users as $item) {
        $date = $item['datevalidation'];
        $datephp = date("Y-m-d");
        $dateValidUnAn = date("Y-m-d", strtotime($date . "+1 year"));
        //Si la date de validation à un an de moins que la date du jour on update le users
        if ($dateValidUnAn <= $datephp) {
            $requete = $pdo->prepare('UPDATE users SET isvalidate = false WHERE email = ?');
            $requete->execute(array($item['email']));
        }
    }
}
//Request pour récupérer les users non validé
function getUsersNonValidate()
{
    global $pdo;
    $requete = $pdo->prepare('SELECT * FROM users WHERE isvalidate = false or datevalidation = null order by email');
    $requete->execute();
    $usersNonValidate = $requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["usersNonValidate"]=$usersNonValidate;
}
//On modifie la valeur de isValidate à true

function setValidation($email)
{
    global $pdo;
    $requete = $pdo->prepare('UPDATE users SET isvalidate = true WHERE email = ?');
    $requete->execute(array($email));

    $date = date("Y-m-d");
    $req = $pdo->prepare('UPDATE users SET datevalidation=? WHERE email = ?');
    $req->execute(array($date, $email));
    header('Location: ../../Controler/Admin/Validation.php');
    exit();
}

