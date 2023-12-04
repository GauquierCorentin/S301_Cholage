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
    $equipes=$_SESSION['equipe'];
    $j=0;
    foreach ($equipes as $equipe){
        echo ("<h3> le nom de l'équipe est : ".$equipe[0]."</h3>");
        $membreEquipe=$_SESSION['mbEquipe'];
        foreach ($membreEquipe as $membre){
            if ($membre[2] == $equipe[2]) {
                if ($membre[3] == true){
                    echo ($membre[0]." ".$membre[1]." ".$membre[4]." est capitaine <br>");
                }
                if ($membre[3] == false){
                    echo $membre[0], " ", $membre[1], " ",$membre[4],"<br>";
                }
            }
        }
    }
    ?>
</div>
</body>
</html>
