<?php
require("../../Model/checkSession/checkSession.php");
checkMailValidate();
ob_start();
include("../../View/Chat/chat.php");
include("../../Model/Chat/chat.php");
include_once("../../Model/BDD/ConnexionBDD.php");

$conn= ConnexionBDD::getInstance();
$pdo= $conn::getpdo();

envoyerMess($pdo);
deleteOldMessages($pdo);
loadChat();
?>