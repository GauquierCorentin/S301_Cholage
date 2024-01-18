<?php
include "../../Model/checkSession/checkSession.php";
checkMail();
checkMailOrga();
include "../../Model/Tournoi/CreerMatch.php";
$_SESSION["allMatch"]=getAllMatchTournoi(getLastTournoi()[0]);
include "../../Controller/BarreMenu/BarreMenu.php";
include "../../View/Tournoi/CreerMatch.php";

if($_POST["creerEquipe"]){
    $equipe=getAllEquipeTournoi(getLastTournoi()[0]);
    $allmatch=genererMatch($equipe);
    foreach ($allmatch as $match){
        addMatch(getLastTournoi()[0],$match[0],$match[1]);
    }
    header("Location: ../../Controller/Tournoi/CreerMatch.php");
}
if ($_POST["supprEquipe"]){

}
