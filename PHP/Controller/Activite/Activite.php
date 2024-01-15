<?php
include("../../Model/checkSession/checkSession.php");
checkMailValidate();
include("../../Model/BDD/ConnexionBDD.php");
include("../../Model/Activite/Activite.php");

try {
    $conn = ConnexionBDD::getInstance();
    $pdo = $conn::getpdo();
} catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

getTournois();
include("../../Controller/BarreMenu/BarreMenu.php");
include("../../../PHP/View/Activite/Activite.php");
?>