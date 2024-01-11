<?php
session_start();

function checkMail()
{
    if (!isset($_SESSION['mail'])) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

function checkMailAdmin()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isadmin'] == false) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

function checkMailOrga()
{

    if (!isset($_SESSION['mail']) and $_SESSION['isorganisateur'] == false) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

function checkMailValidate()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isValidate'] == false) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

function checkMailCaptain()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isCaptain'] == false) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

function checkMailOrgaOrAdmin()
{
    if (!isset($_SESSION['mail']) and (!$_SESSION['isadmin'] or $_SESSION['isorganisateur'])) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}
?>

