<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css?v=<?php echo time(); ?>">
</head>

<body>

<?php
include("../../View/BarreMenu/BarreMenu.php");
$tournois= $_SESSION['tournois'];
foreach($tournois as $activite){
    echo '<a href="afficheActivite.php">';
    echo '<div class="activite border border-3 border-primary rounded">';
    echo '<h4 class="nomT">' . $activite['nomtournoi'] . '</h4>';
    echo '<p class="dateT">' . $activite['datetournoi'] . '</p>';
    echo '<br>';
    echo '<br>';

    echo '</div>';
    echo '</a>';
}
?>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>