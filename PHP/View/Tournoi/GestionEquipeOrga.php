<?php
include ("../../View/BarreMenu/BarreMenu.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css">
    <link rel="stylesheet" href="../../View/Style/styleGestionEquipeOrga.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<div class="GestionEquipeOrga-container-fluid GestionEquipeOrga-mx">
    <div class="row">
        <div class="col-xl-3"></div>
        <div class="col-xl-6">
            <?php
            foreach($_SESSION["lstEquipes"] as $lstEquipe){
                echo '<div class="card" style="width: 75%;">
                <div class="card-body">
                    <h5 class="card-title">'.$lstEquipe[0].'</h5>
                    <p class="card-text">
                    <div class="list-group">';
                foreach ($_SESSION["membreEquipe".$lstEquipe[0]] as $membreEquipe){
                    echo '<li class="list-group-item list-group-item-primary" draggable="true">'.$membreEquipe["nom"]." ".$membreEquipe["prenom"].'</li>';
                };
                echo '</div>
                    <input type="hidden" id="equipe'.$lstEquipe[0].'" value="'.$lstEquipe[0].'">
                    <input type="button" id="equipe" value="Supprimer" onclick="supprEquipe(document.getElementById(\'equipe'.$lstEquipe[0].'\').value)">
                    </p>
                </div>
            </div>
            <br><br>';
            }
            ?>
        </div>

        <div class="col-xl-3 DivJoeurSansEquipe">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action" draggable="true">A simple default list group item</a>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item list-group-item-primary">This is a primary list group item</li>
                <li class="list-group-item list-group-item-secondary">This is a secondary list group item</li>
                <li class="list-group-item list-group-item-success">This is a success list group item</li>
                <li class="list-group-item list-group-item-danger">This is a danger list group item</li>
                <li class="list-group-item list-group-item-warning">This is a warning list group item</li>
                <li class="list-group-item list-group-item-info">This is a info list group item</li>
                <li class="list-group-item list-group-item-light">This is a light list group item</li>
                <li class="list-group-item list-group-item-dark">This is a dark list group item</li>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>
    function supprimerEquipe(idequipe) {
        $.ajax({

            url:("../../Model/Tournoi/SupprEquipe.php"),
            type: 'POST',
            data: { action: 'supprEquipe',data: idequipe },
            success: function(response) {
                // Traitement de la réponse du serveur, si nécessaire
                console.log('Réponse du serveur :', response);
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', error);
            }
        });
    }
    function supprEquipe(idequipe){
        Swal.fire({
            title: "Supression équipe"
        })
    }
</script>
</body>
</html>
