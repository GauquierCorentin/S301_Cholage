<?php
session_start();
require_once '../../View/BarreMenu/BarreMenu.php';
require_once '../../View/Admin/Validation.html';
require_once '../../Model/Admin/Validation.php';

global $usersNonValidate;
echo ('test');
echo $usersNonValidate;

if ($usersNonValidate == null){
    echo '<h1>Il n\'y a pas d\'utilisateur à valider</h1>';
}

//On affiche dans un tableau html tous les user Non Validé
foreach ($usersNonValidate as $item){
    echo '<form method="post">';
        echo '<tr>';
            echo '<td>'.$item['id'].'</td>';
            echo '<td>'.$item['nom'].'</td>';
            echo '<td>'.$item['prenom'].'</td>';
            echo '<td>'.$item['isValidate'].'</td>';
            echo '<td><a href="../../Model/Admin/Validation.php?id='.$item['id'].'">Valider</a></td>';
        echo '</tr>';
    echo '</form>';
}



