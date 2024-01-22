<?php
session_start();

/**
 * @return void
 * Fonction pour verifier si l'utilisateur est connecté avec un compte
 * @author Corentin Gauquier
 */
function checkMail()
{
    if (!isset($_SESSION['mail'])) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

/**
 * @return void
 * Fonction pour verifier si l'utilisateur est connecté avec un compte et est administrateur
 * @author Corentin Gauquier
 */
function checkMailAdmin()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isadmin'] == false) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

/**
 * @return void
 * Fonction pour verifier si l'utilisateur est connecté avec un compte et est organisateur
 * @author Corentin Gauquier
 */
function checkMailOrga()
{

    if (!isset($_SESSION['mail']) and $_SESSION['isorganisateur'] == false) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

/**
 * @return void
 * Fonction pour verifier si l'utilisateur est connecté avec un compte et est validé
 * @author Corentin Gauquier
 */
function checkMailValidate()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isValidate'] == false) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

/**
 * @return void
 * Fonction pour verifier si l'utilisateur est connecté avec un compte et est capitaine d'équipe
 * @author Corentin Gauquier
 */
function checkMailCaptain()
{
    if (!isset($_SESSION['mail']) and $_SESSION['isCaptain'] == false) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}

/**
 * @return void
 * Fonction pour verifier si l'utilisateur est connecté avec un compte et est admin et organisateur
 * @author Corentin Gauquier
 */
function checkMailOrgaOrAdmin()
{
    if (!isset($_SESSION['mail']) and (!$_SESSION['isadmin'] or $_SESSION['isorganisateur'])) {
        header('Location: http://localhost:63342/S301_Cholage/PHP/Controller/Accueil/Accueil.php');
    }
}
?>

