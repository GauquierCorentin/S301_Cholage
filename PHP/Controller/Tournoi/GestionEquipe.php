<?php
session_start();
include ("../../Model/Tournoi/GestionEquipe.php");
if($_SESSION["equipe"]==null) {
    $_SESSION["Membres"] = getMembre_Role($_SESSION["equipe"]);
    $_SESSION["NomEquipe"] = getNomEquipe($_SESSION["equipe"]);
    $_SESSION["MembresInvitables"] = getMembreSansEquipe();
}
include ("../../View/Tournoi/GestionEquipe.php");

if($_SESSION["equipe"]==false){
    ?>
    <script>
        Swal.fire({
            title: 'Pas d\'équipe'
            text: 'Vous n\'avez pas d\'équipe'
            icon: 'error'
        });
    </script>
        <?php
}
if (isset($_POST["SupprEquipe"])){
    ?>
        <script>
            function supprimerEquipe(idequipe) {
                console.log('Fonction supprimerEquipe appelée avec succès.');
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

        Swal.fire({
            icon: 'warning',
            title: 'Nouvelle Équipe',
            text: 'Vous allez dissoudre l\'équipe',
            showConfirmButton: true,
            showCancelButton: true,
            cancelButtonText: "Annuler",
            confirmButtonText: "Valider"
        }).then((result) => {
            if(result.isConfirmed){
                supprimerEquipe(document.getElementById("idequipe").value);
                window.location.href("../../View/")
            }
        });
        </script>
        <?php
}

