<?php
require_once ('../../View/BarreMenu/BarreMenu.php');
require_once ('../../Model/Tournoi/ShowQuestionnaire.php');
require_once ('../../View/Tournoi/ShowQuestionnaire.php');

$questionnaires = getQuesitionnaires();
$questions = getQuestions();


$_SESSION['showQuestionnaires'] = $questionnaires;
$_SESSION['showQuestions'] = $questions;

getRep($_SESSION['idquestion']);