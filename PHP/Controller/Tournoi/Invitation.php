<?php
include("../../Model/Tournoi/Invitation.php");
include("../../View/Tournoi/Invitation.html");
ob_start();
$email=$_GET["email"];
$token=$_GET["token"];
$equipe=getequipeToken($token)[0];
if (gettype($equipe)=="NULL"){
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Token inexistant',
            text: 'Le token n\'existe pas'
        }).then((result)=>{
            if (result) {
                window.location.href ="../../Controller/Accueil/MainPage.php"
            }
        })
    </script>
    <?php
}
else{
$creation=getCreationToken($token)[0];
if (gettype($creation)=='NULL'){
    header("../../View/Accueil/Invitation.php");
    exit();
}
$creation=date_create($creation);
$copieDate=$creation;
$decalage=date_interval_create_from_date_string("1 days");
$copieDate->add($decalage);
if ($creation>$copieDate){
    ?>
    <script>
        console.log("il ya une erreur")
        Swal.fire({
            icon: 'error',
            title: 'Lien Expiré',
            text: 'Le lien a expiré'
        }).then((result)=>{
            if (result) {
                window.location.href ="../../Controller/Accueil/MainPage.php"
            }
        })
    </script>
<?php
}
else{
    rejoindreEquipe($equipe,$email,$token);
    ?>
    <script>
        console.log("ya une erreur dans le swal")
        Swal.fire({
            icon: 'success',
            title: 'Equipe rejointe',
            text: 'Vous avez rejoint l\'équipe'
        }).then((result)=>{
            if(result) {
                window.location.href = "../../Controller/Accueil/MainPage.php"
            }
        })
    </script>
    <?php
}
}