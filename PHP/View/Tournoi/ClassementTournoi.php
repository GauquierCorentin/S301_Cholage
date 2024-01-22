
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<br>
<select name="Tournoi" id="Tournoi" onchange="mettreAjour()">
    <option value="">--Please choose an option--</option>
    <?php
    foreach ($_SESSION["Tournoi"] as $tournoi){
        echo '<option value="'.$tournoi[0].'/'.$tournoi[1].'">'.$tournoi[1].' '.$tournoi[2].'</option>';

    }
    ?>
</select>
<br><br>
<h1 id="titrePage">Classement du tournoi </h1>

<script>
    function mettreAjour(){
        var choix=event.target
        var choixsplit=choix.value.split("/")
        document.getElementById("titrePage").textContent="Classement du tournoi "+choixsplit[1]
        ResultTournoiAjax(choixsplit[0])
    }
    function ResultTournoiAjax(idtournoi){
        $.ajax({
            url:"../../Model/Tournoi/ResultTournoiAjax.php",
            type:"POST",
            data:{idtournoi:idtournoi},
            success: function (response){
                ReponseResult(response)
            },
            error: function (error){
                console.error(error)
            }
        })
    }
    function ReponseResult(response){
        var result=response.split("/")
        console.log(result)

        if (document.getElementById('tableau')) {
            document.body.removeChild(document.getElementById("tableau"))
        }

        var div=document.createElement("div")
        div.id="tableau"
        var table=document.createElement("table")
        table.className="tableau"
        div.appendChild(table)

        var thead=document.createElement("thead")
        thead.className="thead"
        var tr=document.createElement("tr")

        var thClassement=document.createElement("th")
        thClassement.scope="col"
        thClassement.textContent="classement"
        tr.appendChild(thClassement)

        var thEquipe=document.createElement("th")
        thEquipe.scope="col"
        thEquipe.textContent="Equipe"
        tr.appendChild(thEquipe)

        var thVictoire=document.createElement("th")
        thVictoire.scope="col"
        thVictoire.textContent="Victoire"
        tr.appendChild(thVictoire)

        var thDefaite=document.createElement("th")
        thDefaite.scope="col"
        thDefaite.textContent="Defaite"
        tr.appendChild(thDefaite)
        thead.appendChild(tr)

        table.appendChild(thead)
        document.body.appendChild(div)

        var tbody=document.createElement("tbody")
        table.appendChild(tbody)
        i=0


        result.forEach(function ajoutresult(equipe){
            if (equipe!=="") {
                var resultatEquipe = equipe.split(":;!")
                var trbody = document.createElement("tr")
                tbody.appendChild(trbody)

                resultatEquipe.forEach(function ajouttableau(element) {
                    var td = document.createElement("td")
                    td.textContent = element
                    trbody.appendChild(td)

                })
            }

        })
    }
</script>
</body>
