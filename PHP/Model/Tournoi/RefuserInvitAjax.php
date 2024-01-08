<?php
include "../../Model/Tournoi/Invitation.php";
$token=$_POST["token"];
deleteToken($token);
