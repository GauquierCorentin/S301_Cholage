<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once '../../View/BarreMenu/BarreMenu.php';
require_once ('../../Model/Tournoi/AjouterQuestionnaire.php');
require_once ('../../View/Tournoi/AjouterQuestionnaire.php');

if (isset($_POST['submit'])){
    $nom = $_POST['nom'];
    addQuestionnaire($nom);
    $idquestionnaire = getQuestionnaire()[0];
    $nbQuestion = $_POST['nbQuestion'];
    for($i=0 ; $i<$nbQuestion; $i++ ) {
        $question = $_POST['question' . $i];
        addQuestion($question, $idquestionnaire);
        $i++;
    }

}