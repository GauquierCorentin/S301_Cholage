<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>liste des équipes</title>
    <link rel="stylesheet" href="../Style/styleCholage.css">
</head>
<body>
<div class="header">
    <h1>Liste des équipes inscrites au tournoi</h1>
</div>
<?php
$equipes = $_SESSION['LstEquipe'];
$tournois = $_SESSION['Tournoi'];
$j = 0;

foreach ($tournois as $tournoi) {
    echo "<div class='container' style='text-align: left; margin-left: 16%; margin-right: 40%'>";
    echo "<div class='row' style='text-align: left'>";
    echo "<div class='col-18' style='text-align: left'>";
    echo "<div class='card' style='text-align: left; margin-left: 20%; margin-right: 20%'>";
    echo "<div class='card-body' style='text-align: left'>";
    echo "<h2>Tournoi " . $tournoi['annee'] . "</h2>";
    foreach ($equipes as $equipe) {
        if (($equipe['idtournoi'] == $tournoi['idtournoi'])) {
            echo("<ul><h3> équipe : " . $equipe[0] . "</h3>");
            $membreEquipe = $_SESSION['mbEquipe'];
            foreach ($membreEquipe as $membre) {
                if ($membre[2] == $equipe[2]) {
                    if ($membre[3]) {
                        echo("<li>" . $membre[0] . " " . $membre[1] . " " . $membre[4] . " est <B>capitaine </B> </li><br>");
                    }
                    if (!$membre[3]) {
                        echo("<li>" . $membre[0] . " " . $membre[1] . " " . $membre[4] . "</li><br>");
                    }
                }
            }
            echo("</ul>");
        }
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

?>
</body>
</html>
