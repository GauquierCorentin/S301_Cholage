<?php
include("../../Model/Tournoi/Invitation.php");
include("../../View/Tournoi/Invitation.html");
ob_start();
$email=$_GET["email"];
$token=$_GET["token"];
$equipe=getequipeToken($token)[0];
$nomequipe=getNomEquipe($equipe);
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
    ?>
    <script>

        function accepterInvitationAjax(idequipe,token,email){
            $.ajax({
                url:"../../Model/Tournoi/AccepterInvitAjax.php",
                type:"POST",
                data:{idequipe:idequipe,token:token,email:email},
                success: function(response) {
                    console.log('Réponse du serveur :', response);
                    location.reload()
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX:', error);
                }
            })
        }
        function refuserInvitationAjax(token){
            $.ajax({
                url:"../../Model/Tournoi/RefuserInvitAjax.php",
                type:"POST",
                data:{token:token},
                success: function(response) {
                    console.log('Réponse du serveur :', response);
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX:', error);
                }
            })
        }

        Swal.fire({
            icon: 'warning',
            title: 'rejoindre l\'équipe',
            text: 'Voulez-vous rejoindre l\'équipe',
            cancelButtonText:"ne pas rejoindre",
            confirmButtonText:"rejoindre",
            showCancelButton:true,
            showConfirmButton:true
        }).then((result)=>{
            if(result.isConfirmed) {
                accepterInvitationAjax('<?php echo $equipe?>','<?php echo $token ?>','<?php echo $email?>')
                window.location.href="../../View/Accueil/MainPage.php"
            }
            else{
                refuserInvitationAjax('<?php echo $token?>')
                window.location.href="../../View/Accueil/MainPage.php"
            }
        })
    </script>
    <?php
}
}