<?php
include("ValiderResultat.php");
$idmatch=$_POST["idmatch"];
echo($idmatch);
$resultat=$_POST["resultat"];
changerResultMatch($idmatch,$resultat);
