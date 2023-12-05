<?php
include("../../Model/checkSession/checkSession.php");
checkMailValidate();
include("../../Model/BDD/ConnexionBDD.php");
include("../../../PHP/View/Activite/Activite.php");
include("../../Model/Activite/Activite.php");

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

$tournois= getTournois();
?>