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
/**
 * On récupère tout les users de la bdd
 * @author WILLIAME Anthony
 * @return array
 */
function getusers()
{
    global $pdo;
    $requete = $pdo->prepare('SELECT * FROM users order by email');
    $requete->execute();
    $users = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

/**
 * On récupère les utilisateur et on leurs attribut une date de validation qui dure un an
 * @author WILLIAME Anthony
 */
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
/**
 * On récupère tout les users non validé de la bdd et on les
 * stock dans une variable de session pour les afficher dans la vue Validation.php
 * @author WILLIAME Anthony
 */
function getUsersNonValidate()
{
    global $pdo;
    $requete=$pdo->prepare('SELECT * FROM users WHERE isvalidate= false or datevalidation = null order by email');
    $requete->execute();
    $usersNonValidate = $requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["usersNonValidate"]=$usersNonValidate;
}
//On modifie la valeur de isValidate à true

/**
 * On update la valeur de isValidate à true et on attribut la date du jour à la date de validation
 * @author WILLIAME Anthony, GALOUIN Matisse
 * @param $email
 *
 */
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

