<?php
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
        foreach ($qr as $r) {
            $val = '<script> let nom = ("<?php $_POST[`$qr-$r`] ?>"); getChecked(); </script> ';
            addRep($reps[$r], $val, $user);
        }
    }
}

?>
<script>
    function getChecked(nom) {
        return document.getElementById(nom).value
    }
</script>
