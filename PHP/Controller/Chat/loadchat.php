<?php
session_start();
require("../../Model/BDD/ConnexionBDD.php");
$conn= ConnexionBDD::getInstance();
$bdd= $conn::getpdo();

$recupMsg= $bdd->query("SELECT * FROM messages order by date desc");


while($message= $recupMsg->fetch()){
    ?>
    <div class="message">
        <p><?=$message['fullname']?> : <?=$message['message']?></p>
    </div>
    <?php
    }

?>

