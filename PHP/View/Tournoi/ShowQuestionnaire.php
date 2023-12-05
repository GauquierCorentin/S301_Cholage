<?php
$questionnaires = $_SESSION['showQuestionnaires'];
$questions = $_SESSION['showQuestions'];

?>
<script src="../../Model/Fonctions/functions.js"></script>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Répondre aux questionnaires</title>
    <link rel="stylesheet" href="../Style/styleCholage.css">
</head>

<body>
<form method="POST" action="ShowQuestionnaire.php">
    <?php
    echo($_SESSION['mail']);
    $_SESSION['qr'] = array();
    foreach($questionnaires as $questionnaire) {
        echo('<div class="questionnaire">');
        echo('<h1>' . $questionnaire['nom'] . '</h1>');
        $q = 0;
        foreach($questions as $question) {
            echo('<div class="question">');
            echo('<h2>' . $question['textequestion'] . '</h2>');
            $reponses = getRep($question['idquestion']);
            $r = 0;
            foreach($reponses as $reponse) {
                echo('<div class="reponse">');
                echo('<input type="radio" id="q' . $q . 'r' . $r . '" name="q' . $q . '" value="' . $reponse['textreponse'] . '">');
                echo('<label for="q' . $q . 'r' . $r . '">' . $reponse['textreponse'] . '</label>');
                echo('</div>');
                $r++;
            }
            echo('</div>');
            $q++;
        }
        echo('<input type="submit" value="valider">');
        echo('</div>');
    }


    echo("<br>");
    echo('</div>');
    ?>

</form>
</body>
