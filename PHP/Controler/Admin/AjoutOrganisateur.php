<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include ('../../View/BarreMenu/BarreMenu.php');
?>
<?php
require ("../../Model/Admin/AjoutOrganisateur.php");
require ("../../View/Admin/AjoutOrganisateur.php");
header("Cache-Control: no-cache, must-revalidate");
recupUsersNonOrga();
if (isset($_POST["submit"])){
    echo $_POST["test"];
    //UpdateStatut($_POST["test"]);
}

