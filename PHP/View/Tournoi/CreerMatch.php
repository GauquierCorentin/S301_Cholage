<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion de l'équipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<br>
<input type="button" value="créer tous les matchs" name="creerEquipe">
<input type="button" value="supprimer tous les matchs" name="supprEquipe">
<div>
    <table class="tableau">
        <tr>
            <th>Mail</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Role</th>
            <th>Exclure</th>
        </tr>
<?php
$listeMatchCharge=$_SESSION["allMatch"];
foreach ($listeMatchCharge as $match){
    echo 
}
?>
</body>
