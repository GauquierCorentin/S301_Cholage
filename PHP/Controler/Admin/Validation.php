<?php
require_once '../../View/BarreMenu/BarreMenu.php';
require_once '../../Model/Admin/Validation.php';
global $pdo;

if($_SESSION['isadmin'] == false || $_SESSION['isadmin'] == null){
    header('Location: ../../View/Accueil/MainPage.php');
}

$dateValidation = get_dateValidation($pdo);

$usersNonValidate = get_usersNonValidate($pdo);

if (isset($_POST['submit'])){
    feur($pdo);
}