<?php
session_start();
include("../../View/Accueil/Register.php");

require("../../Model/Accueil/Register.php");

@signIn($_POST['mail'], $_POST['mdp'], $_POST['mdpcheck']);
?>

