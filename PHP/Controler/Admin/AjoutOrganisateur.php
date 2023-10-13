<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<?php
require ("../../Model/Admin/AjoutOrganisateur.php");
require ("../../View/Admin/AjoutOrganisateur.php");
recupUsersNonOrga();
if (isset($_POST["submit"])){
    UpdateStatut($_POST["test"]);
}

