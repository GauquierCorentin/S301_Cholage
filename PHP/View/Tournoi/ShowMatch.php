<?php
$matchs = $_SESSION['matchs'];
$nomEquipeAdverse = $_SESSION['nomEquipeAdverse'];
$nomEquipe= $_SESSION['nomEquipe'];
$matchId = $_SESSION['idmatch'];
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
    $i=0;
    foreach ($matchs as $match){
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-18'>";
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>Votre Equipe</h5>";
        echo "<p class='card-text'>Equipe : " . $nomEquipe[0] . "</p>";
            echo("<input type='hidden' name='idMatch' value='$match[2]' id='$match[2]'>");
        if ($_SESSION['isCaptain']==1){
        echo("<input type='button' class='btn btn-primary' name='match' value='Miser' onclick='ajouterParis()'></input>");
        }
        echo "<h5 class='card-title'>Equipe adverse</h5>";
        echo "<p class='card-text'>Equipe : " . $nomEquipeAdverse[$i][0] . "</p>";
        echo("</div>");
        echo("</div>");
        echo("</div>");
        echo("</div>");
        echo("</div>");
        $i++;
    }
    ?>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>
    function ajouterParis(){

        Swal.fire({
            input: "text",
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: "valider",
            cancelButtonText: "annuler"
        }).then((result)=> {
            if (result.value) {
                AjaxAjoutEquipe(`${result.value}`{
                    var divCard = document.createElement("div");
                    divCard.className = "card";
                    divCard.style.width = "75%";
                    divCard.ondrop = drop;
                    divCard.ondragover = activerdrop;
                    divCard.id=`${result.value}`

                    var divCardBody = document.createElement("div");
                    divCardBody.className = "card-body";
                    divCardBody.id="body/"+idequipe;
                    divCard.appendChild(divCardBody);

                    var divCardTittle = document.createElement("h5");
                    divCardTittle.className = "card-tittle";
                    divCardTittle.textContent = `${result.value}`
                    divCardTittle.id="tittle/";
                    divCardBody.appendChild(divCardTittle);

                })
            }
        });
    }

    function AjaxAjoutJoueurEquipe(){
        $.ajax({
            url: "../../Model/Tournoi/AjoutJoueurAjax.php",
            type : "POST",
            data: {idjoueur:idjoueur,idequipe:idequipe},
            success: function (response){
                console.log(response)
            },
            error: function (xhr,status,error){
                console.error(error)
            }
        });
    }
</script>
</body>
</html>