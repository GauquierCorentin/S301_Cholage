<!DOCTYPE html>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion Organisateur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
        crossorigin="anonymous">
  <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">
  <title>Validation d'un utilisateur</title>
</head>
<body>
<div>
  <table class="tableau">
    <tr>
        <th>Mail</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Valider</th>
    </tr>
      <?php
      $users=$_SESSION["users"];
        foreach ($users as $item){
            echo "<form method='post'>";
                echo "<tr class='test'>";
                echo "<td>". $item["email"]."</td>";
                echo '<input type="hidden" name="test" value="' . $item['email'] . '">';
                echo '<td>' . $item['nom'] . '</td>';
                echo '<td>' . $item['prenom'] . '</td>';
                echo '<td><input type="submit" name="submit" value="Valider"></td>';
                echo '</tr>';
            echo '</form>';

        }
      ?>
  </table>
</div>

</body>
</html>