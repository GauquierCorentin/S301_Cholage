<?php

class Premier
{
    /* permet lors des vérifications de l'entrée desdonnées de savoir si la page vien d'être lancée ou si */
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
