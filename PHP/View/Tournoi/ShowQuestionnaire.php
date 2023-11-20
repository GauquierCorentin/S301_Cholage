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
    <link rel="stylesheet" href="../../CSS/Style.css">
</head>

<body>
<form method="POST">
    <?php

    foreach ($questionnaires as $i) {
        echo('<div>');
        echo($i[1] . "<br>");
        foreach ($questions as $q) {
            if ($q[2] == $i[0]) {
                echo($q[1] . "<br>");
                $_SESSION['idQuestion'] = $q[0];
                $reponses = getRep($_SESSION['idQuestion']);
                foreach ($reponses as $r){
                    echo($r . "<br>");
                }
            }
        }
    }
    echo("<br>");
    echo('</div>');

    ?>
</form>
</body>