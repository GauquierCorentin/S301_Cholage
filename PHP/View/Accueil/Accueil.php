<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <header>
        <a class="logo" href="Accueil.php">
            <img src="../../View/Image/logo0.png" width=200 height=200 alt="">
        </a>
        <br><br>
    </header>

    <form method="post">
        <div class="form-group">
            <input type="email" class="form-control form-acc" placeholder="Email" name="mail" id="mail" required>
        </div>

        <div class="form-group">
            <input type="password" class="form-control form-acc" placeholder="Password" name="mdp" id="mdp" required>
        </div>

        <div>
            <input type="submit" name="logSubmit" id="logSubmit" class="btn btn-info btn-sub-acc btn-lg" value="Confirmer">
        </div>
    </form>
    <a class="lien" href="Register.php">Créer un compte</a>
    <br>
    <a class="lien" href="../../View/Password/RequestResetPassword.php">Mot de passe oublié ?</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
