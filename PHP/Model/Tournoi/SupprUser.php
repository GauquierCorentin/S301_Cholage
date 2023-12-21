<?php
/**
 * @author Gallouin Matisse
 * @param $iduser
 * permet de supprimer un utilisateur à l'aide d'ajax avec des données obtenus d'une session
 */
include ("GestionEquipe.php");
session_start();
$iduser=$_SESSION["mail"];
global $pdo ;
$req=$pdo->prepare("Update users set equipe_id=null,iscaptain=false where email=?");
$req->execute(array($iduser));
$_SESSION["equipe"]=null;
$_SESSION["isCaptain"]=null;