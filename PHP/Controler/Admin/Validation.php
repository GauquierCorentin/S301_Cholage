<?php
session_start();
require_once '../../View/BarreMenu/BarreMenu.php';
require_once '../../View/Admin/Validation.html';
require_once '../../Model/Admin/Validation.php';
global $usersNonValidate;

if ($usersNonValidate == null){
    echo '<h1>Il n\'y a pas d\'utilisateur à valider</h1>';
}

//On affiche dans un tableau html tous les user Non Validé
foreach ($usersNonValidate as $item){
    echo '<form method="post" action="../../Model/Admin/Validation.php">';
        echo '<tr>';
            echo '<td>'.$item['email'].'</td>';
            $email = $item['email'];
            echo '<td><input type="submit" name="submit" value="Valider"></td>';
        echo '</tr>';
    echo '</form>';
}



