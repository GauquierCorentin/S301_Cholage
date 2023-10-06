<?php
require_once '../../Model/Admin/Validation.php';
require_once '../../View/Admin/Validation.php';
global $pdo;

if($_SESSION['isadmin'] == false || $_SESSION['isadmin'] == null){
    header('Location: ../../View/Accueil/MainPage.php');
}

$dateValidation = get_dateValidation($pdo);

$usersNonValidate = get_usersNonValidate($pdo);

$_SESSION['usersNonValidate'] = $usersNonValidate;

if (isset($_POST['submit'])){
    update_isValidate($pdo);
}