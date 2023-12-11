<?php
require_once "../../View/BarreMenu/BarreMenu.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion de l'équipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../../Model/Fonctions/functions.js"></script>
    <script>
        function inviter(mail,equipe){
            $.ajax({
                url:"../../Model/Tournoi/InviterAjax.php",
                type:"POST",
                data:{action:"inviter",mail:mail,equipe:equipe},
                success: function(response) {
                    // Traitement de la réponse du serveur, si nécessaire
                    console.log('Réponse du serveur :', response);
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX:', error);
                }
            })
        }
        function envoyerInvitation(mail,equipe){
            event.target.disabled=true
            event.target.value="invité"
            inviter(mail,equipe)
        }
        function exclure(mail){
            $.ajax({
                url:"../../Model/Tournoi/ExclureUser.php",
                type:"POST",
                data:{action:"exclu",mail:mail},
                success: function(response) {
                    console.log('Réponse du serveur :', response);
                    location.reload()
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX:', error);
                }
            })
        }
        function ExclureJoueur(mail){
            Swal.fire({
                icon: 'warning',
                title: 'Exclure un joueur',
                text: 'Vous allez exclure un joueur',
                showConfirmButton: true,
                showCancelButton: true,
                cancelButtonText: "Annuler",
                confirmButtonText: "Valider"
            }).then((result)=>{
                if(result.value){
                    exclure(mail)
                }
            })

        }


    </script>
</head>
<body>


<?php
echo "<h1>" . $_SESSION["NomEquipe"][0] . "</h1>";
?>
<div>
    <form method="post">
        <input type="button" name="inviter" data-bs-toggle="modal" data-bs-target="#Invitation" value="inviter des joueurs">
        <?php
        echo '<input type="hidden" name="idequipe" id="idequipe" value="' . $_SESSION["equipe"] . '">';
            if ($_SESSION["isCaptain"]==true){
                echo "<input type='submit' name='SupprEquipe'  value='Dissoudre  l équipe'>";
                echo '<input type="hidden" name="idequipe" id="idJoueurExclu" value="0">';
            }
            else{
                echo "<input type='submit' name='QuitterEquipe' value='Quitter l équipe'>";
            }
        ?>

    </form>
</div>
<input class=searchbar id="searchbar" onkeyup="search_Nom()" type="text"
       name="search" placeholder="recherche Nom">
<div>
    <table class="tableau">
        <tr>
            <th>Mail</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Role</th>
            <th>Exclure</th>
        </tr>
        <?php
        $i=0;
            foreach ($_SESSION["Membres"] as $item){
                echo "<form method='post'>";
                echo "<tr class='test'>";
                echo "<td>". $item["email"]."</td>";
                echo '<input type="hidden" name="test" id="email'.$i.'" value="' . $item['email'] . '">';
                echo '<td>' . $item['prenom'] . '</td>';
                echo '<td>' . $item['nom'] . '</td>';
                if ($item["iscaptain"]==true){
                    echo'<td>Capitaine</td>';
                }else{
                    echo '<td>Membre</td>';
                }
                if ($_SESSION["isCaptain"]==true && $item["email"]!=$_SESSION["mail"]) {
                    echo '<td><input type="button" id="exclure'.$i.'" name="exclure" value="Exclure" onclick="ExclureJoueur(document.getElementById(\'email'.$i.'\').value)"></td>';
                }
                else{
                    echo'<td></td>';
                }
                echo '</tr>';
                echo "</form>";
                $i++;
}
?>
    </table>
</div>
<!-- Div afin d'afficher deux bouton distinc pour la gestion des invitations -->
<div class="modal fade" id="Invitation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Que voulez-vous faire ?</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class=searchbar id="searchbar2" onkeyup="search_Nom_Plu_Barre(2)" type="text"
                       name="search" placeholder="recherche Nom">
                <div>
                    <table class="tableau">
                <tr>
                    <th>Mail</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Inviter</th>
                </tr>
<?php
$i=0;
foreach ($_SESSION["MembresInvitables"] as $item){
    echo "<form method='post'>";
    echo "<tr class='test'>";
    echo "<td>". $item["email"]."</td>";
    echo '<input type="hidden" name="email" id="email'.$i.'" value="' . $item['email'].'">';
    echo '<input type="hidden" id="nbJoueur'.$i.'" value='.$i.'>';
    echo '<td>' . $item['nom'] . '</td>';
    echo '<td>' . $item['prenom'] . '</td>';
    echo '<td><input type="button" id="inviter'.$i.'" name="inviter" value="Inviter" onclick="envoyerInvitation(document.getElementById(\'email'.$i.'\').value,\''.$_SESSION["equipe"].'\')"">';
    echo '</tr>';
    echo "</form>";
    $i++;
}
?>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
