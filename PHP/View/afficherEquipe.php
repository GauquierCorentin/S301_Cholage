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
    $equipes=$_SESSION['equipes'];
    $j=0;
    foreach ($equipes as $equipe){
        echo ("<h3> le nom de l'équipe est : ".$equipe[1]."</h3>");
        $membreEquipe=$_SESSION['mbEquipe'];
        for ($a = 0; $a<sizeof($_SESSION['mbEquipe']) ;$a++){
            echo $_SESSION['mbEquipe'][$a];
        }
    }
    ?>
</div>
</body>
</html>