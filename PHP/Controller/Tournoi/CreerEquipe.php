<?php
require("../../Model/checkSession/checkSession.php");
checkMailValidate();
checkMailCaptain();
include("../../Controller/BarreMenu/BarreMenu.php");
require_once("../../View/Tournoi/CreationEquipe.html");
require_once ("../../Model/Tournoi/CreerEquipe.php");
ob_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_SESSION["equipe"]!=null || $_SESSION["isCaptain"] == true ){
    ?>
    <script>
    Swal.fire({
                    icon: 'error',
                    text: 'Vous avez déjà une équipe'
        }).then((result) => {
            // Vérifier si le bouton "OK" a été cliqué
            if (result.value) {
                // Redirection côté client
                window.location.href = '../../Controller/Accueil/MainPage.php';
            }
        });
    </script>
    <?php
}

if (isset($_POST["CreerEquipe"])){
    if ($_POST["NameEquipe"]!=null){
        try {
            addEquipe($_SESSION["mail"], $_POST["NameEquipe"], getLastTournoi()[0]);
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Nouvelle Equipe',
                    text: 'Vous avez créez une nouvelle équipe'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '../../Controller/Accueil/MainPage.php';
                    }
                });
            </script>
            <?php
        }catch (PDOException){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Nom utilisé',
                    text: 'Le nom d\'équipe que vous avez utilisé est déjà pris'
                })
                console.log("il y a une erreur")
            </script>
            <?php
        }
    }
}

