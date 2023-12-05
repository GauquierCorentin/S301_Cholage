<?php
require("../../Model/checkSession/checkSession.php");
checkMailValidate();
require_once ('../../View/BarreMenu/BarreMenu.php');
require_once ('../../Model/Tournoi/ShowQuestionnaire.php');
require_once ('../../View/Tournoi/ShowQuestionnaire.php');

$questionnaires = getQuestionnaires($_SESSION["mail"]);
$questions = getQuestions();


$_SESSION['showQuestionnaires'] = $questionnaires;
$_SESSION['showQuestions'] = $questions;

for ($i = 0; $i < count($questionnaires); $i++) {
    $reps = getReponsesPasRepondues($questionnaires[$i]['id'], $_SESSION['mail']);
    if (isset($_POST['q' . $i])) {
        $qr = array();
        $qr['idquestionnaire'] = $questionnaires[$i]['id'];
        $qr['iduser'] = $_SESSION['mail'];
        $qr['idquestion'] = $questions[$i]['idquestion'];
        $qr['idreponse'] = 0;
        foreach ($reps as $rep) {
            if ($rep[1] == $qr['idquestion']) {
                $qr['idreponse'] = $rep[0];
            }
        }
        $qr['rep'] = $_POST['q' . $i];
        repondre($qr['idquestionnaire'], $qr['idreponse'], $qr['iduser'], $qr['rep']);
    }
}
?>
<script>
    function getChecked(nom) {
        return document.getElementById(nom).value
    }
</script>
