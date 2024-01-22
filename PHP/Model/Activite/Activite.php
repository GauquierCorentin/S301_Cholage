<?php

/**
 * @return array
 * Fonction pour récupérer les informations d'un tournoi
 * @author Corentin Gauquier
 */
function getTournois()
{
    global $pdo;
    $requete= $pdo->prepare('SELECT * FROM iutinfo70.public.tournoi');
    $requete->execute();
    $tournois= $requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["tournois"]= $tournois;
    return $tournois;
}

?>