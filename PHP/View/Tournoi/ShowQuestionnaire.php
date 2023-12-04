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
    foreach ($questionnaires as $i) { // parcourt tous les questionnaires, notés i
        echo('<div>');
        echo("<h1>" . $i[1] . "</h1>" . "<br>");
        $x = 0;
        foreach ($questions as $q) { // parcourt toutes les questions, notées q
            $y = 0;
            if ($q[2] == $i[0]) { // vérifie si la question q est associée au questionnaire i
                echo("<h2>" . $q[1] . "</h2>" . "<br>");
                $_SESSION['idquestion'] = $q[0];
                $reponses = getRep($q[0]); // récupère les réponses liées à la question q
                if (sizeof($reponses) == 0) {
                    echo("<input type='text' name='$x-1'><br>");
                    $y++;
                } else {
                    foreach ($reponses as $r) { // parcourt toutes les réponses liées à la question q, notées r
                        echo($r[1]);                                        //
                        echo("&nbsp;&nbsp;&nbsp;");                         // affiche la question r et une checkbox associée
                        echo("<input type='checkbox' name='$x-$y' ><br>");  //
                        $y++;
                    }
                }
                $qr = array($x, $y);
                echo($qr[0] . '/' . $qr[1]);
                $_SESSION['qr'].array_push($qr);
                $_SESSION['idquestionnaire'] = $i[0];
            }
            $x++;
        }
        echo("<input type='submit' name='submit'>");
    }
    echo("<br>");
    echo('</div>');
    ?>

</form>
</body>
