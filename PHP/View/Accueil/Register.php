<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">
    <script src="../../Model/Fonctions/functions.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<header>
    <a class="lien lien-acc" href="../../Controler/Accueil/Accueil.php">
        <img src="../../View/Image/returnAcc.png" width="50" height="50">
    </a>

    <a class="logo" href="Accueil.php">
        <img src="../../View/Image/logo0.png" width=200 height=200 alt="">
    </a>
    <br><br>
</header>

<form method="post">
    <div class="form-group">
        <input type="email" class="form-control form-acc" placeholder="Email" name="mail" id="mail" aria-describedby="basic-addon1" required>
    </div>

    <div class="form-group">
        <input type="text" class="form-control form-acc" placeholder="Nom" name="nom" id="nom" aria-describedby="basic-addon1" required>
    </div>

    <div class="form-group">
        <input type="text" class="form-control form-acc" placeholder="Prenom" name="prenom" id="prenom" aria-describedby="basic-addon1" required>
    </div>

    <div class="form-group">
        <input type="text" class="form-control form-acc" placeholder="Numero Tel" name="tel" id="tel" aria-describedby="basic-addon1" required>
    </div>

    <div class="form-group form-pw">
        <input type="password" class="form-control form-acc" placeholder="Password" name="mdp" id="mdp" aria-describedby="basic-addon1" required>
        <button type="button" name="seePW" id="seePW" class="btn btn-info btn-PW" onclick="changer('mdp')">0</button>
    </div>

    <div class="form-group">
        <input type="password" class="form-control form-acc" placeholder="Password Check" name="mdpcheck" id="mdpcheck" aria-describedby="basic-addon1" required>
    </div>

    <div>
        <input type="submit" name="logSubmit" id="logSubmit" class="btn btn-info btn-sub-acc btn-lg" value="Confirmer">
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>

