<?php
require("../../Model/checkSession/checkSession.php");
checkMailValidate();
require_once('../../View/BarreMenu/BarreMenu.php');
require_once('../../Model/Tournoi/ShowQuestionnaire.php');
require_once('../../View/Tournoi/ShowQuestionnaire.php');

$questionnaires = getQuestionnaires($_SESSION["mail"]);
$questions = getQuestions();


$_SESSION['showQuestionnaires'] = $questionnaires;
$_SESSION['showQuestions'] = $questions;


if (isset($_POST['submit'])) {
    for ($i = 0; $i < count($questionnaires); $i++) {
        $reps = getReponsesPasRepondues($_SESSION['mail'], $questionnaires[$i]['id']);
        if (isset($_POST['q' . $i])) {
            $qr = array();
            $qr['idquestionnaire'] = $questionnaires[$i]['id'];
            $qr['iduser'] = $_SESSION['mail'];
            $qr['idreponse'] = $reps[0]['idrep'];
            $qr['rep'] = $_POST['q' . $i];
            repondre($qr['idreponse'], $qr['iduser'], $qr['rep'], '');
        }
        validerQuestionnaire($questionnaires[$i][0], $_SESSION['mail']);
    }
}
