<?php
require_once '../../View/BarreMenu/BarreMenu.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un tournoi</title>
    <link rel="stylesheet" href="../../../../CSS/Style.css">
    <script src="../../../../JS/Script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Création tournoi</h1>
    </div>
    <div class="content">

        <form method="post">
            <label for="nom">Nom du tournoi</label>
            <input type="text" name="nom" id="nom" required>
            <br>
            <label for="date">Date du tournoi</label>
            <input type="date" name="date" id="date" required>
            <br>
            <input type="submit" name="envoyer" value="Envoyer">
        </form>
    </div>
</div>
</body>
</html>

