<?php
require("../../Model/checkSession/checkSession.php");
checkMailValidate();
require_once('../../View/BarreMenu/BarreMenu.php');
require_once('../../Model/Tournoi/ShowQuestionnaire.php');

$questionnaires = getQuestionnaires($_SESSION["mail"]);
$questions = getQuestions();


$_SESSION['showQuestionnaires'] = $questionnaires;
$_SESSION['showQuestions'] = $questions;


if (isset($_POST['submit'])) {
    echo('submit' . '<br>');
    echo('nombre de questionnaires : ' . count($questionnaires) . '<br>');
    for ($i = 0; $i < count($questionnaires); $i++) {
        $reps = getReponsesPasRepondues($_SESSION['mail'], $questionnaires[$i]['id']);
        echo ('nombre de réponses : ' . count($reps) . '<br>');
        for ($j = 0; $j < count($reps); $j++) {
            echo($reps[$j]['idrep'] . '<br>');
            $qr = array();
            $qr['idquestionnaire'] = $questionnaires[$i]['id'];
            $qr['iduser'] = $_SESSION['mail'];
            $qr['idreponse'] = $reps[$i]['idrep'];
            $qr['rep'] = $_POST['q'.$i.'r'.$j];
            echo ($qr['rep'] . '<br>');
            if ($qr['rep'] == 'Oui') {
                $qr['rep'] = true;
            } else {
                $qr['rep'] = false;
            }
            echo ($qr['rep'] . '<br>');
            echo('Type de la réponse : '.gettype($qr['rep']).'<br>');
            echo($qr['idreponse'] . '-' . $qr['iduser'] . '<br>');
            repondre($qr['idreponse'], $qr['iduser'], $qr['rep'], '');
        }
        echo($questionnaires[$i][0] . '-' . $_SESSION['mail']);
        validerQuestionnaire($questionnaires[$i]['id'], $_SESSION['mail']);
    }
    echo('fin');
}
$_POST['submit'] = null;

require_once('../../View/Tournoi/ShowQuestionnaire.php');