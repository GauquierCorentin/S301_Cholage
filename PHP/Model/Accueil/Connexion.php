<?php

class Connexion
{
    /**
     * @param $bdd
     * @param $mail
     * @param $password
     * @return bool */

    function logUser($bdd, $mail, $password) {
        $sql=$bdd->prepare("SELECT * FROM test1 where mail= ?");
        $sql->BindParam(1,$mail);
        $sql->execute();

        $row= $sql->fetch(PDO::FETCH_ASSOC);

        if(password_verify($password, $row['password']) and $mail==$row['mail']){
            return true;
        } else {
            return false;
        }

    }

}