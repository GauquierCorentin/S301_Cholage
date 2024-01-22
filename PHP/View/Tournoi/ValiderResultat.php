<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Valider résultat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<br>
<?php
$matchsansResult=$_SESSION["matchSansResult"];
$idequipe=$_SESSION["equipe"];
foreach ($matchsansResult as $match){
    if ($idequipe==$match[1]) {
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-12'>";
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-title'>" . $match[4] . " vs " . $match[5] . " </h4>";
        echo "<p class='card-text'> Combien de tours ont été effectués?<br> <input type='number' id='nombre/" . $match[0] . "'> <br><br> <input type='button' class='btn btn-primary' value='valider' onclick='RentrerResult(\"$match[0]\")'></p>";
        echo "</div></div>";
        echo "<br>";
    }
}
$matchavecResult=$_SESSION["matchAvecResult"];
foreach ($matchavecResult as $match){
    if ($idequipe==$match["equipechole"] and ($match["valideresultat"]===false)) {
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-12'>";
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-title'>" . $match["nomequipe1"] . " vs " . $match["nomequipe2"] . " </h4>";
        echo "<p class='card-text'> L'équipe adverse a refusé votre ancien résultat <br> <input type='number' id='nombre/" . $match["idmatch"] . "'> <br><br> <input type='button' class='btn btn-primary' value='valider' onclick='RentrerResult(\"$match[idmatch]\")'></p>";
        echo "</div></div>";
        echo "<br>";
    }
    elseif ($idequipe==$match["equipechole"]){
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-12'>";
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-title'>" . $match["nomequipe1"] . " vs " . $match["nomequipe2"] . " </h4>";
        echo "<p class='card-text'>Vous avez donnée le résultat ".$match["resultatdonnee"]."</p>";
        echo "</div></div>";
        echo "<br>";
    }
    else{
        if($match["valideresultat"]==null and $match["valideresultat"]===null) {
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<div class='col-12'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h4 class='card-title'>" . $match["nomequipe1"] . " vs " . $match["nomequipe2"] . " </h4>";
            echo "<p class='card-text'>L'équipe " . $match["nomequipe1"] . " a donné le résultat " . $match["resultatdonnee"] . "<br><br><input type='button' class='btn btn-primary' value='accepter' onclick='AccepterAjax(\"$match[idmatch]\")'>  <input type='button' class='btn btn-primary' value='refuser' onclick='RefuserAjax(\"$match[idmatch]\")'></p>";
            echo "</div></div>";
            echo "<br>";
        }
        elseif($match["valideresultat"]==true){
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<div class='col-12'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h4 class='card-title'>" . $match["nomequipe1"] . " vs " . $match["nomequipe2"] . " </h4>";
            echo "<p class='card-text'>Vous avez validé le score</p>";
            echo "</div></div>";
            echo "<br>";
        }
        else{
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<div class='col-12'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h4 class='card-title'>" . $match["nomequipe1"] . " vs " . $match["nomequipe2"] . " </h4>";
            echo "<p class='card-text'>L'équipe " . $match["nomequipe1"] . " a donné le résultat " . $match["resultatdonnee"] . " <br>Vous avez refuser le résultat<br><br><input type='button' class='btn btn-primary' value='accepter' onclick='AccepterAjax(\"$match[idmatch]\")'>  <input type='button' class='btn btn-primary' value='refuser' onclick='RefuserAjax(\"$match[idmatch]\")'></p>";
            echo "</div></div>";
            echo "<br>";
        }
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script>
    function RentrerresultAjax(idmatch,resultat){
        $.ajax({
            url:"../../Model/Tournoi/RentrerResultAjax.php",
            type:"POST",
            data:{idmatch:idmatch,resultat:resultat},
            success: function(response) {
                console.log('Réponse du serveur :', response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', error);
            }
        })
    }
    function RentrerResult(idmatch){
        RentrerresultAjax(idmatch,document.getElementById("nombre/"+idmatch).value)
    }

    function AccepterAjax(idmatch){
    $.ajax({
            url:"../../Model/Tournoi/AccepterAjax.php",
            type:"POST",
            data:{idmatch:idmatch},
            success: function(response) {
                console.log('Réponse du serveur :', response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', error);
            }
        })
    }
    function RefuserAjax(idmatch){
    $.ajax({
            url:"../../Model/Tournoi/RefuserAjax.php",
            type:"POST",
            data:{idmatch:idmatch},
            success: function(response) {
                console.log('Réponse du serveur :', response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', error);
            }
        })
    }

</script>
</body>

</html>