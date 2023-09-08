<?php
session_start();

include("../../View/Accueil/Accueil.php");

require("../../Model/BDD/ConnectionBDD.php");

$conn= ConnectionBDD::getInstance();
$pdo=$conn::getpdo();

?>