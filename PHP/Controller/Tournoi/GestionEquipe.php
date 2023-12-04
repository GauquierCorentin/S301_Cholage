<?php
session_start();
include ("../../Model/Tournoi/GestionEquipe.php");
$_SESSION["Membres"] = getMembre_Role($_SESSION["equipe"]);
$_SESSION["NomEquipe"] = getNomEquipe($_SESSION["equipe"]);
$_SESSION["MembresInvitables"] = getMembreSansEquipe();
include ("../../View/Tournoi/GestionEquipe.php");
if($_SESSION["equipe"]==null){
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Pas d\'équipe',
            text: 'Vous n\'avez pas d\'équipe'
        }).then((result) => {
            // Vérifier si le bouton "OK" a été cliqué
            if (result.value) {
                // Redirection côté client
                window.location.href = '../../View/Accueil/MainPage.php';
            }
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
                Swal.fire({
                    icon: 'success',
                    title: 'Supprimer Equipe',
                    text: 'Vous avez supprimer l\'équipe'
                }).then((result) => {
                    // Vérifier si le bouton "OK" a été cliqué
                    if (result.value) {
                        // Redirection côté client
                        window.location.href = '../../View/Accueil/MainPage.php';
                    }
                });
            }
        });
        </script>
        <?php
}
if (isset($_POST["QuitterEquipe"])){
    ?>
        <script>
    function supprimerUser() {
        console.log('Fonction supprimerEquipe appelée avec succès.');
        $.ajax({

                    url:("../../Model/Tournoi/SupprUser.php"),
                    type: 'POST',
                    data: { action: 'supprEquipe'},
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
        title: 'Quitter Équipe',
        text: 'Vous allez quitter l\'équipe',
        showConfirmButton: true,
        showCancelButton: true,
        cancelButtonText: "Annuler",
        confirmButtonText: "Valider"
    }).then((result) => {
        if(result.isConfirmed){
            supprimerUser();
            Swal.fire({
                icon: 'success',
                title: 'Quitter Equipe',
                text: 'Vous avez quittez l\'équipe'
            }).then((result) => {
                // Vérifier si le bouton "OK" a été cliqué
                if (result.value) {
                    // Redirection côté client
                    window.location.href = '../../View/Accueil/MainPage.php';
                }
            });
        }
    });
        </script>
<?php
}
if (isset($_POST["inviter"])){
    inviter($_POST["email"],$_SESSION["equipe"]);
    exit();
}