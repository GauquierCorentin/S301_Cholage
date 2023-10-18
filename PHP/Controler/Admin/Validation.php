<?php
ob_start();
require_once '../../View/BarreMenu/BarreMenu.php';
require_once '../../Model/Admin/Validation.php';
getUsersNonValidate();
require_once '../../View/Admin/Validation.php';



if($_SESSION['isadmin'] == false || $_SESSION['isadmin'] == null){
    header('Location: ../../View/Accueil/MainPage.php');
}

if ($_SESSION["usersNonValidate"] == null) {
    echo '<h1>Il n\'y a pas d\'utilisateur à valider</h1>';
}

if (isset($_POST["submit"])){
    setValidation($_POST["test"]);
}