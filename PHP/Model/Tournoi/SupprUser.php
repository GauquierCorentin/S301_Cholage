<?php
session_start();
$iduser=$_SESSION["mail"];
global $pdo ;
$req=$pdo->prepare("Update users set equipe_id=null,iscaptain=false where email=?");
$req->execute(array($iduser));
$_SESSION["equipe"]=null;
$_SESSION["isCaptain"]=null;