<?php

?>
<script src="../../Model/Fonctions/functions.js"></script>
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
<form method="post">
    <div>
        <input type="text" name="nom" placeholder="Nom du questionnaire">
    </div>
    <div>
        <input type="text" name="question0" placeholder="question">
        <input type="hidden" name="nbQuestion" id="nbQuestion" value=0>
    </div>

    <div id="newQ">
        <!-- Ajout des nouvelles questions dans cette div-->
    </div>

    <input type="button" name="addQ" value="Ajouter Question" onclick="addQuestion(document.getElementById('nbQuestion').value)">
    <input type="button" name="removeQ" value="Supprimer Question" onclick="suppQuestion(document.getElementById('nbQuestion').value)">

    <div>
        <input type="submit" name="submit" value="Valider">
    </div>
</form>
</body>
</html>
