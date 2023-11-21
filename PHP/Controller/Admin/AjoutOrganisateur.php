<?php
include('../../View/BarreMenu/BarreMenu.php');
?>
<?php
ob_start();
require_once("../../Model/Admin/AjoutOrganisateur.php");
recupUsersNonOrga();
require_once("../../View/Admin/AjoutOrganisateur.php");
if ($_SESSION['isadmin'] == false || $_SESSION['isadmin'] == null) {
    header('Location: ../../View/Accueil/MainPage.php');
}
if ($_SESSION["users"] == null) {
    echo '<h1>Il n\'y a pas d\'utilisateur à valider</h1>';
}

if (isset($_POST["submit"])) {
    UpdateStatut($_POST["test"]);
    header("Location: AjoutOrganisateur.php?" . uniqid());
    exit();
}

