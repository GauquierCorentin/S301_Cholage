<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande de réinitialisation de mot de passe</title>
    <link rel="stylesheet" href="../../../../CSS/Style.css">
    <script src="../../../../JS/Script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Cholage</h1>
        </div>
        <div class="content">
            <h2>Demande de réinitialisation de mot de passe</h2>
                <form action="../../Controller/Password/RequestResetPassword.php" method="post">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="submit" value="Envoyer">
                </form>
            <p>Cliquez sur le lien contenu dans l'email pour réinitialiser votre mot de passe.</p>
        </div>
    </div>
</body>
</html>
