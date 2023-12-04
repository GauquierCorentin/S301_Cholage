<?php

class Premier
{
    /* permet lors des vérifications de l'entrée des données de savoir si la page vient d'être lancée ou non
    sert à éviter de multiple envoie du formulaire (surement plus utile lors du dev)*/
    /**
     * @param $name
     */
    function premier($name){
        if (($_SESSION[$name]==null)){
            $_SESSION[$name]=1;
        }
        else{
            $_SESSION[$name]=2;
        }
    }
}
