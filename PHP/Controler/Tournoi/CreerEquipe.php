<?php
include("../../View/BarreMenu/BarreMenu.php");
require_once("../../View/Tournoi/CreationEquipe.html");
require_once ("../../Controler/Tournoi/CreerEquipe.php");
require_once ("../../Model/Tournoi/CreerEquipe.php");
ob_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

if (isset($_POST["CreerEquipe"])){
    echo"ma bite1";
    addEquipe($_SESSION["mail"],$_POST["NameEquipe"]/*,gettournoi()[0]*/);
    echo"ma bite";?>
    <script>
    Swal.fire({
                icon: 'success',
                title: 'Nouvelle Equipe',
                text: 'Vous avez créez une nouvelle équipe'
            })
        </script>
<?php
}

