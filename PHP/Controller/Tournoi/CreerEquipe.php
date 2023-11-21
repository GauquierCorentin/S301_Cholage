<?php
include("../../View/BarreMenu/BarreMenu.php");
require_once("../../View/Tournoi/CreationEquipe.html");
require_once("../../Controller/Tournoi/CreerEquipe.php");
require_once ("../../Model/Tournoi/CreerEquipe.php");
ob_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_SESSION["isValidate"]!=true){
    header("Location: ../../View/Accueil/MainPage.php");
    exit();
}
else if ($_SESSION["equipe"]!=null || $_SESSION["isCaptain"] == true ){
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

if (isset($_POST["CreerEquipe"])){
    if ($_POST["NameEquipe"]!=null){
        addEquipe($_SESSION["mail"],$_POST["NameEquipe"]/*,gettournoi()[0]*/);
        ?>
        <script>
        Swal.fire({
                    icon: 'success',
                    title: 'Nouvelle Equipe',
                    text: 'Vous avez créez une nouvelle équipe'
        }).then((result) => {
            // Vérifier si le bouton "OK" a été cliqué
            if (result.value) {
                // Redirection côté client
                window.location.href = '../../View/Accueil/MainPage.php';
            }
        });
        </script>
<?php }
}

