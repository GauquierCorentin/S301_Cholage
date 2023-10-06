<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once '../../View/BarreMenu/BarreMenu.php';
    ?>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
          crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">
    <title>Validation d'un utilisateur</title>
</head>
<body>

<input class=searchbar id="searchbar" onkeyup="search_Nom()" type="text"
       name="search" placeholder="recherche Nom">

<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
global $usersNonValidate;

if ($usersNonValidate == null) {
echo '<h1>Il n\'y a pas d\'utilisateur à valider</h1>';
}

//On affiche dans un tableau html tous les user Non Validé
echo '<table class="tableau">';
    echo '<tr>';
        echo '<th>Mail</th>';
        echo '<th>Nom</th>';
        echo '<th>Prenom</th>';
        echo '<th>Valider</th>';
        echo '</tr>';
    foreach ($usersNonValidate as $item) {
    echo '<form method="post">';
        echo '<tr class="test">';
            echo '<td>' . $item['email'] . '</td>';
            echo '<input type="hidden" name="test" value="' . $item['email'] . '">';
            echo '<td class="nom">' . $item['nom'] . '</td>';
            echo '<td>' . $item['prenom'] . '</td>';
            echo '<td><input class="btn btn-info btn-sub-acc" type="submit" name="submit" value="Valider"></td>';
            echo '</tr>';
        echo '</form>';
    }
    echo('</table>');
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
<script src="../../Model/Fonctions/functions.js"></script>
</html>