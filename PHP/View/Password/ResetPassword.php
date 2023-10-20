<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande de réinitialisation de mot de passe</title>
    <link rel="stylesheet" href="../../../../CSS/Style.css">
    <script src="../../../../JS/Script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Cholage</h1>
    </div>
    <div class="content">
        <h2>Réinitialisation de mot de passe</h2><br>
        <form method="post">
            <input type="password" name="pass1" placeholder="Nouveau Mot de Passe" required><br><br>
            <input type="password" name="pass2" placeholder="Confirmer Mot de Passe" required><br><br>
            <input type="submit" name="submit" value="Envoyer">
        </form>

    </div>
</div>
</body>
</html>

