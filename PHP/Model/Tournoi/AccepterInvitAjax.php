<?php
include "../../Model/Tournoi/Invitation.php";

$idequipe=$_POST["idequipe"];
$token=$_POST["token"];
$email=$_POST["email"];

rejoindreEquipe($idequipe,$email,$token);

