<?php
include("../../Model/Tournoi/Invitation.php");
include ("../../View/Tournoi/Invtation.html");
ob_start();
$email=$_GET["email"];
$token=$_GET["token"];
$equipe=$_GET["equipe"];

$creation=getCreationToken($token)[0];
if (gettype($creation)=='NULL'){
    header("../../View/Accueil/Invitation.php");
    exit();
}
$creation=date_create($creation);
$copieDate=$creation;
$decalage=date_interval_create_from_date_string("1 day");
$copieDate->add($decalage);

if ($creation>$decalage){
    ?>
    <script>
        Swal.fire({
            title: "Lien expiré"
            text: "le lien d'invitation à expiré"
            icon:"error"
        }).then((result)=>{
            if (result) {
                window.location.href ="../../View/Accueil/MainPage.php"
            }
        })
    </script>
<?php
}
else{
    rejoindreEquipe($equipe,$email);
    ?>
    <script>
        Swal.fire({
            title: "Equipe rejointe"
            text : "Vous avez rejoint l'équipe"
            icon : "success"
        }).then((result)=>{
            if(result) {
                window.location.href = "../../View/Accueil/MainPage.php"
            }
        })
    </script>
    <?php
}