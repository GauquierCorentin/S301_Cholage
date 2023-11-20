<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ob_start();
require_once '../../View/BarreMenu/BarreMenu.php';
require_once('../../Model/Tournoi/ShowQuestionnaire.php');
require_once('../../View/Tournoi/ShowQuestionnaire.php');

$questionnaires = getQuesitionnaires();
$questions = getQuestions();


$_SESSION['showQuestionnaires'] = $questionnaires;
$_SESSION['showQuestions'] = $questions;


function showReponses($id){
    $_SESSION['showReponses'] = getReponses($id);
}