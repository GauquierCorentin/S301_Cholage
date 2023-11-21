<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
include ("../../Model/Tournoi/GestionEquipe.php");

$_SESSION["Membres"]=getMembre_Role($_SESSION["equipe"]);
$_SESSION["NomEquipe"]=getNomEquipe($_SESSION["equipe"]);
$_SESSION["MembresInvitables"]=getMembreSansEquipe();

include ("../../View/Tournoi/GestionEquipe.php");

if (isset($_POST["SupprEquipe"])){
    header("Location: ../../View/Accueil/MainPage.php");
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Nouvelle Equipe',
            text: 'Vous avez déjà une équipe'
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

