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

getRep($_SESSION['idquestion']);

$reps = getReps($_SESSION['idquestionnaire']);

if (isset($_POST["submit"])) {
    $user = $_SESSION["mail"];
    foreach ($_SESSION['qr'] as $qr) {
        $val = '<script> let nom = ('. $_POST[`$qr[0]-$qr[1]`].') getChecked(); </script> ';
        addRep($reps[$qr], $val, $user);
        valider($_SESSION['idquestionnaire'], $user);
    }
}

?>
<script>
    function getChecked(nom) {
        return document.getElementById(nom).value
    }
</script>
