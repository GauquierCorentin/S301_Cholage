<?php
include "../../Model/checkSession/checkSession.php";
checkMail();
checkMailOrga();
include "../../Model/Tournoi/CreerMatch.php";
$_SESSION["allMatch"]=getAllMatchTournoi(getLastTournoi()[0]);
include "../../Controller/BarreMenu/BarreMenu.php";
include "../../View/Tournoi/CreerMatch.php";
if(isset($_POST["creerMatch"])){
    $equipe=getAllEquipeTournoi(getLastTournoi()[0]);
    $allmatch=genererMatch($equipe);

    foreach ($allmatch as $match){
        if($match[0]!=0 and $match[1]!=0){
            addMatch(getLastTournoi()[0], $match[0][0], $match[1][0]);
        }
    }
    header("Location: ../../Controller/Tournoi/CreerMatch.php");
}
