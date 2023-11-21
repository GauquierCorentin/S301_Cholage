<?php
require_once "../../View/BarreMenu/BarreMenu.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion de l'équipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
echo "<h1>".$_SESSION["NomEquipe"][0]."</h1>";
?>
<div>
    <form method="post">
        <input type="submit" name="inviter" value="inviter des joueurs">
        <input type='submit' name='SupprEquipe' value='Dissoudr  l équipe'>
        <?php
           /* if ($_SESSION["isCaptain"]==true){
                echo "<input type='submit' name='SupprEquipe' value='Dissoudre  l équipe'>";
            }
            else{
                echo "<input type='submit' name='QuitterEquipe' value='Quitter l équipe'>";
            }*/
        ?>

    </form>
</div>
<input class=searchbar id="searchbar" onkeyup="search_Nom()" type="text"
       name="search" placeholder="recherche Nom">
<div>
    <table class="tableau">
        <tr>
            <th>Mail</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Exclure</th>
        </tr>
        <?php
            foreach ($_SESSION["Membres"] as $item){
                echo "<form method='post'>";
                echo "<tr class='test'>";
                echo "<td>". $item["email"]."</td>";
                echo '<input type="hidden" name="test" value="' . $item['email'] . '">';
                echo '<td>' . $item['nom'] . '</td>';
                echo '<td>' . $item['prenom'] . '</td>';
                if ($_SESSION["isCaptain"]==true && $item["email"]!=$_SESSION["mail"]) {
                    echo '<td><input type="submit" id="submit" name="submit" value="Exclure"></td>';
                }
                else{
                    echo'<td></td>';
                }
                echo '</tr>';
                echo "</form>";
}
?>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
