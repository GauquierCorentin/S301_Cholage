<?php
session_start();
include("../../View/Accueil/Accueil.php");
?>

<?php
require("../../Model/BDD/ConnexionBDD.php");
require("../../Model/Accueil/Connexion.php");

$conn= ConnexionBDD::getInstance();
$pdo= $conn::getpdo();
$Conn= new Connexion();

if(isset($_POST['mail'])){
    if(@$Conn->logUser($pdo, $_POST['mail'], $_POST['mdp'])){
        $_SESSION['mail']= $_POST['mail'];
        header('Location: MainPage.php');
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Impossible de trouver votre compte.'
            })
        </script>
        <?php
    }
}
?>

