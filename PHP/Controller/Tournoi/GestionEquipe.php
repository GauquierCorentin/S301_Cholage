<?php
session_start();
ob_start();
include ("../../Model/Tournoi/GestionEquipe.php");

$_SESSION["Membres"]=getMembre_Role($_SESSION["equipe"]);
$_SESSION["NomEquipe"]=getNomEquipe($_SESSION["equipe"]);
$_SESSION["MembresInvitables"]=getMembreSansEquipe();

include ("../../View/Tournoi/GestionEquipe.php");

if (isset($_POST["SupprEquipe"])){
    ?>
    <script>
        Swal.fire({
            icon:"warning",
            title: "Supression équipe",
            text: "Vous allez supprimer léquipe",
            showCancelButton: true,
            confirmButtonText: "Valider",
            cancelButtonText: "Annulez"
        })
    </script>
<?php
}

