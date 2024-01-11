<?php
require("../../Model/checkSession/checkSession.php");
checkMailValidate();
require_once('../../View/BarreMenu/BarreMenu.php');
require_once('../../Model/Tournoi/ShowQuestionnaire.php');

$questionnaires = getQuestionnaires($_SESSION["mail"]);
$questions = getQuestions();


$_SESSION['showQuestionnaires'] = $questionnaires;
$_SESSION['showQuestions'] = $questions;
foreach ($questionnaires as $questionnaire){
    echo ("test");
    if (isset($_POST['submit'.$questionnaire[0]['id']])) {
        $nbq = $_POST['nbq'];
        for ($i = 0; $i <= $nbq; $i++) {
            $nbrep = $_POST['nbrep' . $i];
            for ($j = 0; $j <= $nbrep; $j++) {
                if (($_POST['q' . $i . 'r' . $j])=="Oui") {

                }
            }
        }
    }
}

require_once('../../View/Tournoi/ShowQuestionnaire.php');