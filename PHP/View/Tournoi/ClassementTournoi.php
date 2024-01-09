<?php
include "../../View/BarreMenu/BarreMenu.php";
?>
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
<select name="Tournoi" id="Tournoi" onchange="mettreAjour()">
    <option value="">--Please choose an option--</option>
    <?php
    foreach ($_SESSION["Tournoi"] as $tournoi){
        echo '<option value="'.$tournoi[0].'/'.$tournoi[1].'">'.$tournoi[1].' '.$tournoi[2].'</option>';

    }
    ?>
</select>
<h1 id="titrePage">Classement du tournoi </h1>


<script>
    function mettreAjour(){
        var choix=event.target
        var choixsplit=choix.value.split("/")
        document.getElementById("titrePage").textContent="Classment du tournoi "+choixsplit[1]
        ResultTournoiAjax(choixsplit[0])
    }
    function ResultTournoiAjax(idtournoi){
        $.ajax({
            url:"../../Model/Tournoi/ResultTournoiAjax.php",
            type:"POST",
            data:{idtournoi:idtournoi},
            success: function (response){
                console.log(typeof response)
            },
            error: function (error){
                console.error(error)
            }
        })
    }
    function ReponseResult(response){
        
    }
</script>
</body>
