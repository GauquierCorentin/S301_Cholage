<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion Organisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
          crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Validation d'un utilisateur</title>
</head>
<body>
<script src="../../Model/Fonctions/functions.js"></script>
<input class=searchbar id="searchbar" onkeyup="search_Nom()" type="text"
       name="search" placeholder="recherche Nom">
<div>
    <table class="tableau">
        <tr>
            <th>Mail</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Enlever l'Organisateur</th>
        </tr><?php
        $users=$_SESSION["users"];
        foreach ($users as $item){
            echo "<form method='post'>";
            echo "<tr class='test'>";
            echo "<td>". $item["email"]."</td>";
            echo '<input type="hidden" name="test" value="' . $item['email'] . '">';
            echo '<td>' . $item['nom'] . '</td>';
            echo '<td>' . $item['prenom'] . '</td>';
            echo '<td><input type="submit" id="submit"  name="submit" value="Retirer"></td>';
            echo '</tr>';
            echo "</form>";
        }
        ?></table>
</div>

</body>
</html>
