<?php

require("../../Model/BDD/ConnexionBDD.php");
require("Premier.php");

function signIn($mail, $mdp, $mdpcheck)
{
    $session = new Premier();
    $session->premier('first');
    @$nom = $_POST['nom'];
    @$prenom = $_POST['prenom'];

    if ($_SESSION['first'] == 2) {
        if($mdp==$mdpcheck){
            try {
                $conn = ConnexionBDD::getInstance();
                $pdo = $conn::getpdo();
            } catch (PDOException $e) {
                die ('Erreur : ' . $e->getMessage());
            }
            $hash = password_hash($mdp, PASSWORD_DEFAULT);
            $sql = "INSERT INTO test1 VALUES (:mail,:hash,:nom,:prenom)";
            $req = $pdo->prepare($sql);
            $req->bindParam('mail',$mail);
            $req->bindParam('hash', $hash);
            $req->bindParam('nom', $nom);
            $req->bindParam('prenom', $prenom);
            $user = $pdo->prepare("SELECT * FROM test1 WHERE mail=?");
            $user->execute(array($mail));

            if ($user->fetch()) {
                echo '<script>alert("le compte a déjà été crée.")</script>';
            }

            try {
                $req->execute();
                $req->setFetchMode(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                die ($e->getMessage());

            }
            header('Location: Accueil.php');
        }
    }
}
