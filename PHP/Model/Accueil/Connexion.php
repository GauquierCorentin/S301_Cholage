<?php

class Connexion
{
    // Fonction servant a se connecter au site après verification des informations de connexion
    /**
     * @param $bdd
     * @param $mail
     * @param $password
     * @return bool
     * @author Corentin Gauquier
     */
    function logUser($bdd, $mail, $password) {
        $sql=$bdd->prepare("SELECT * FROM users where email= ?");
        $sql->BindParam(1,$mail);
        $sql->execute();

        $row= $sql->fetch(PDO::FETCH_ASSOC);

        if(password_verify($password, $row['password']) and $mail==$row['email']){
            $_SESSION['mail']=$mail;
            $_SESSION['isValidate']=$row["isvalidate"];
            $_SESSION['isCaptain']=$row["iscaptain"];
            $_SESSION['equipe']=$row["equipe_id"];
            $_SESSION['isorganisateur']=$row['isorganisateur'];
            $_SESSION['isadmin']=$row['isadmin'];
            $_SESSION['fullname']= $row['nom'] . ' ' . $row['prenom'];
            return true;
        } else {
            return false;
        }

    }

}
