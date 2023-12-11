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
    echo('submit' . '<br>');

    for ($i = 0; $i < count($questionnaires); $i++) {
        $reps = getReponsesPasRepondues($_SESSION['mail'], $questionnaires[$i]['id']);
        for ($j = 0; $j < count($reps); $j++) {
            echo($reps[$j]['idrep'] . '<br>');
            $qr = array();
            $qr['idquestionnaire'] = $questionnaires[$i]['id'];
            $qr['iduser'] = $_SESSION['mail'];
            $qr['idreponse'] = $reps[$i]['idrep'];
            $qr['rep'] = $_POST['q' . $j];
            echo ($qr['rep'] . '<br>');
            if ($qr['rep'] == 'Oui') {
                $qr['rep'] = true;
            } else {
                $qr['rep'] = false;
            }
            echo ($qr['rep'] . '<br>');
            echo($qr['idreponse'] . '-' . $qr['iduser'] . '<br>');
            repondre($qr['idreponse'], $qr['iduser'], $qr['rep'], '');
        }
        echo($questionnaires[$i][0] . '-' . $_SESSION['mail']);
        validerQuestionnaire($questionnaires[$i]['id'], $_SESSION['mail']);
    }
    echo('fin');
}
$_POST['submit'] = null;
