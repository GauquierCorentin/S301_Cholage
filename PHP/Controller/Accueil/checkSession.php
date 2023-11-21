<?php
function checkMail()
{
    if (!isset($_SESSION['mail'])) {
        header('Location: Accueil.php');
    }
}

function checkMailAdmin()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isadmin'] == false) {
        header('Location: Accueil.php');
    }
}

function checkMailOrga()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isorganisateur'] == false) {
        header('Location: Accueil.php');
    }
}

function checkMailValidate()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isValidate'] == false) {
        header('Location: Accueil.php');
    }
}

function checkMailCaptain()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isCaptain'] == false) {
        header('Location: Accueil.php');
    }
}
?>

