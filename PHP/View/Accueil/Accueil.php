<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">
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
            <input type="email" class="form-control" placeholder="Email" name="mail" id="mail" aria-describedby="basic-addon1" required>
        </div>

        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="mdp" id="mdp" aria-describedby="basic-addon1" required>
        </div>

        <div>
            <button type="submit" name="logSubmit" id="logSubmit" class="btn btn-info btn-sub-acc">Confirmer</button>
        </div>
    </form>
    <a class="lien" href="Register.php">Créer un compte</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
