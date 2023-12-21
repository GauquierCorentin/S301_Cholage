<?php

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création d'un questionnaire</title>
    <link rel="stylesheet" href="../../CSS/Style.css">
</head>
<body>

<div class="header">
    <h1>Création d'un questionnaire</h1>
</div>
<!--
<form method="post">
    <div>
        <input type="text" name="nom" placeholder="Nom du questionnaire">
    </div>
    <div>
        <input type="hidden" name="nbQuestion" id="nbQuestion" value=0>
        <input type="hidden" name="nbReponseQ" id="nbReponseQ0" value=0>
    </div>

    <div id="newQ">
       Ajout des nouvelles questions dans cette div
    </div>

    <input type="button" name="addQ" value="Ajouter Question" onclick="addQuestion(document.getElementById('nbQuestion').value,document.getElementById('nbReponseQ'+document.getElementById('nbQuestion').value).value)">
    <input type="button" name="removeQ" value="Supprimer Question" onclick="suppQuestion(document.getElementById('nbQuestion').value)">
    <input type="button" name="addRep" value="Ajouter réponse" onclick="addReponse(document.getElementById('nbQuestion').value,document.getElementById('nbReponseQ'+document.getElementById('nbQuestion').value).value)">
    <div>
        <input type="submit" name="submit" value="Valider">
    </div>
</form>
<script src="../../Model/Fonctions/functions.js"></script>
!-->

<h2>
    Veuillez cliquer sur ce lien afin de créer un google forms : <a href="https://docs.google.com/forms/u/0/">Créer un google forms</a>
</h2>

<form method="POST">
    <div>
        <input type="text" name="lien" placeholder="Lien du google forms">
    </div>
    <div>
        <input type="submit" name="submit" value="Valider">
    </div>
</form>
</body>
</html>
