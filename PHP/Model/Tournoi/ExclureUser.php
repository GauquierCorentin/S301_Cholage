<?php

session_start();
$iduser=$_POST["iduser"];
global $pdo;
$req = $pdo->prepare("Update users set equipe_id=null,iscaptain=false where email=?");
$req->execute(array($iduser));