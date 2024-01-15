<?php
$matchs = $_SESSION['matchs'];
$nomEquipeAdverse = $_SESSION['nomEquipeAdverse'];
$nomEquipe= $_SESSION['nomEquipe'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Show Match</title>
</head>
<body>
<h1>Voici la liste des matchs qu'ils vous restent a effectuer : </h1>
<form method="POST">
    <?php
    foreach ($matchs as $match){
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-18'>";
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>Votre Equipe</h5>";
        echo "<p class='card-text'>Equipe : " . $nomEquipe[0] . "</p>";
        foreach ($matchId as $idMatch){
            echo("<input type='hidden' name='idMatch' value='$idMatch[0]'>");
        }
        if ($_SESSION['isCaptain']==1){
        echo("<button type='submit' class='btn btn-primary' name='match'>Miser</button>");
        }
        echo "<h5 class='card-title'>Equipe adverse</h5>";
        echo "<p class='card-text'>Equipe : " . $nomEquipeAdverse[0][0] . "</p>";
        echo("</div>");
        echo("</div>");
        echo("</div>");
        echo("</div>");
        echo("</div>");

    }
    ?>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>