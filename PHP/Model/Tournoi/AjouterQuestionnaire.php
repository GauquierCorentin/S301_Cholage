<?php
require_once '../../Model/BDD/ConnexionBDD.php';
require("../../Model/Includes/PHPMailer/src/Exception.php");
require("../../Model/Includes/PHPMailer/src/PHPMailer.php");
require ("../../Model/Includes/PHPMailer/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

/**
 * Fonction qui permet d'ajouter le questionnaire a la table questionnaire
 * @author WILLIAME Anthony
 * @param $nom type string
 * @return void
 */
function addQuestionnaire($nom){
    global $pdo;
    $req = $pdo->prepare('INSERT INTO questionnaire VALUES (default,?)');
    $req->execute(array($nom));
    $users = getUsersValidate();
    $q = getQuestionnaire()[0];
    foreach ($users as $u) {
        $req = $pdo->prepare('insert into repqestionnaire values (?, ?, false)');
        $req->execute(array($u[0], $q));
    }
}

/**
 * Fonction qui permet de récupérer le dernier questionnaire ajouté dans la table questionnaire
 * @author WILLIAME Anthony
 * @return mixed
 */
function getQuestionnaire(){
    global $pdo;
    $req = $pdo->prepare('SELECT id FROM questionnaire order by id desc');
    $req->execute();
    $questionnaire = $req->fetch();
    return $questionnaire;
}

/**
 * Fonctio qui ajoute une question dans la table question et retourne l'id de la question ajoutée
 * @author WILLIAME Anthony, Gallouin Matisse
 * @param $question
 * @param $idquestionnaire
 * @return mixed
 */
function addQuestion($question,$idquestionnaire){
    global $pdo;
    $req = $pdo->prepare('INSERT INTO question VALUES (default,?,?)');
    $req->execute(array($question,$idquestionnaire));

    $idquestion = $pdo->prepare('SELECT idquestion FROM question order by idquestion desc');
    $idquestion->execute();
    $idquestions = $idquestion->fetch();
    return $idquestions[0];
}

/**
 * @author WILLIAME Anthony, GALLOUIN Matisse, WEBER Guilhem
 * Fonction qui ajoute une réponse dans la table reponse
 * @param $reponse
 * @param $idquestion
 * @return void
 */
function addReponse($reponse,$idquestion){
    global $pdo;
    $reqA = $pdo->prepare('select email from users where isvalidate = true');
    $reqA->execute();
    $users = $reqA->fetchAll();
    foreach ($users as $u) {
        $req = $pdo->prepare('INSERT INTO reponse VALUES (default,?,false,?,?)');
        $req->execute(array($reponse,$idquestion,$u[0]));
    }
}

/**
 * Fonction qui permet de récupérer tous les utilisateurs validés dans la table users
 * @autor WILLIAME Anthony
 * @return array|false
 */
function getUsersValidate(){
    global $pdo;
    $req = $pdo->prepare('SELECT email from users where isvalidate= true');
    $req -> execute();
    $users = $req->fetchAll();
    return $users;
}

function sendMailQuestionnaire($email){

    $mailer = new PHPMailer(true);
    try {

        //Server settings
        $mailer->SMTPDebug = 0;
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = 'cholage.offi@gmail.com';
        $mailer->Password = 'fufvajtuygojmfro';
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;
        //Recipients
        $mailer->setFrom('cholage.offi@gmail.com', 'Cholage');
        $mailer->Subject = 'Nouveau questionnaire';
        //Remplacer le "S301_Cholage" par le nom du dossier qui contient le projet
        $mailer->Body = 'Bonjour, nous avons le plaisir de vous annoncer que vous avez un questionnaire à remplir';
        $mailer->addAddress($email);
        $mailer->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
}