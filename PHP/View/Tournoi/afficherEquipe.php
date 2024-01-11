<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>liste des équipes</title>
    <link rel="stylesheet" href="../../CSS/Style.css">
</head>
<body>
<div class="header">
    <h1>Liste des équipes inscrites au tournoi</h1>
</div>
<div>
    <?php
    $equipes=$_SESSION['LstEquipe'];
    $tournois=$_SESSION['Tournoi'];
    $j=0;
    foreach ($tournois as $tournoi) {
        echo "<div>";
        echo "<h2>Tournoi " . $tournoi['annee'] . "</h2>";
        foreach ($equipes as $equipe) {
            if (($equipe['idtournoi'] == $tournoi['idtournoi'])){
                echo("<h3> équipe : " . $equipe[0] . "</h3>");
                $membreEquipe = $_SESSION['mbEquipe'];
                foreach ($membreEquipe as $membre) {
                    if ($membre[2] == $equipe[2]) {
                        if ($membre[3] == true) {
                            echo($membre[0] . " " . $membre[1] . " " . $membre[4] . " est <B>capitaine </B> <br>");
                        }
                        if ($membre[3] == false) {
                            echo $membre[0], " ", $membre[1], " ", $membre[4], "<br>";
                        }
                    }
                }
            }
        }
        echo "</div>";
    }
    ?>
</div>
</body>
</html>
