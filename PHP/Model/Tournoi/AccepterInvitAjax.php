<?php
/**
 * @author Gallouin Matisse
 * permet de rejoindre à l'aide d'ajax
 */
include "../../Model/Tournoi/Invitation.php";

$idequipe=$_POST["idequipe"];
$token=$_POST["token"];
$email=$_POST["email"];

rejoindreEquipe($idequipe,$email,$token);

