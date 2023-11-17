<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ob_start();
require_once '../../View/BarreMenu/BarreMenu.php';
require_once ('../../Model/Tournoi/AjouterQuestionnaire.php');
require_once ('../../View/Tournoi/AjouterQuestionnaire.php');

if (isset($_POST['submit'])){
    $nom = $_POST['nom'];
    addQuestionnaire($nom);
    $idquestionnaire = getQuestionnaire()[0];
    $nbQuestion = $_POST['nbQuestion'];
    $nbQuestion = (int) $nbQuestion;
    print($nbQuestion);
    for($i=0 ; $i<=$nbQuestion; $i++ ) {
        $question = $_POST['question' . $i];
        $idquestion=addQuestion($question, $idquestionnaire);
        for ($j=1; $j<=$_POST['nbReponseQ'.$i]; $j++){
            echo('I au début du j : '.$i.'\n');
            $reponse = $_POST["Q".$i.'reponse'.$j];
            addReponse($reponse,$idquestion);
        }
    }
    header('Location: ../../Controler/Tournoi/AjouterQuestionnaire.php');
    exit();
}