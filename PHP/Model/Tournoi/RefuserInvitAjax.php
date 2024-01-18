<?php
/**
 * @author Gallouin Matisse
 * permet de refuser l'invitation et de la supprimer dans la BDD
 */
include "../../Model/Tournoi/Invitation.php";
$token=$_POST["token"];
deleteToken($token);
