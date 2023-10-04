<?php
session_start();
require_once '../../View/BarreMenu/BarreMenu.php';
require_once '../../View/Admin/Validation.html';
require_once '../../Model/Admin/Validation.php';
global $usersNonValidate;

if($_SESSION['isadmin'] == false || $_SESSION['isadmin'] == null){
    header('Location: ../../View/Accueil/MainPage.php');
}

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
    echo '<form method="post" action="../../Model/Admin/Validation.php">';
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



