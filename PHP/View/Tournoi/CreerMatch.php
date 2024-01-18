<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion de l'équipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<br>
<?php
if(gettype($_SESSION["allMatch"])!="NULL"){
    echo '<input type="button" value="supprimer tous les matchs" name="supprEquipe" onclick="">';
}
else{
    echo '<input type="button" value="créer tous les matchs" name="creerEquipe">';
}
?>
<div>
    <table class="tableau">
        <tr>
            <th>Equipe 1</th>
            <th></th>
            <th>Equipe 2</th>
            <th>Heure</th>
            <th></th>
        </tr>
<?php
$listeMatchCharge=$_SESSION["allMatch"];
if (gettype($listeMatchCharge)!="NULL") {
    foreach ($listeMatchCharge as $match) {
        echo "<tr>";
        echo "<td>" . $match[1] . "</td>";
        echo "<td>vs</td>";
        echo "<td>" . $match[2] . "</td>";
        if (gettype($match[3])!="NULL") {
            echo "<td><input type='time' id='heure/'".$match[0]." min='8:00' max='18:00' value='".$match[3]."'></td>";
        }
        else{
            echo "<td><input type='time' id='heure/'".$match[0]." min='8:00' max='18:00' ></td>";
        }
        echo "<td><button onclick='changerheure(/".$match[0].")'>changer l'heure</button></td>";
        echo "</tr>";
    }
}
else{
    echo "Aucun Match";
}
?>

    </table>
</div>
<script>
    function changerHeureAjax(idmatch,heure){
        $.ajax({
            url:"../../Model/Tournoi/ChangerHeureAjax.php",
            type:"POST",
            data:{idmatch:idmatch,heure:heure},
            success: function(response) {
                // Traitement de la réponse du serveur, si nécessaire
                console.log('Réponse du serveur :', response);
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', error);
            }
        })
    }
    function changerheure(idmatch){
        let heure=document.getElementById("heure/"+idmatch).value
        changerHeureAjax(idmatch,heure)
    }
    function SupprAllMatch(){
        Swal.fire({
            icon: 'warning',
            title: 'Suppression des matchs',
            text: 'Vous allez supprimez tous les matchs',
            showConfirmButton: true,
            showCancelButton: true,
            cancelButtonText: "Annuler",
            confirmButtonText: "Valider"
        }).then((result)=>{
            if(result.value){
                SupprAllMatchAjax()
            }
        })
    }
    function SupprAllMatchAjax(){
        $.ajax({
            url:"../../Model/Tournoi/SupprAllMatchAjax.php",
            type:"POST",
            success: function(response) {
                // Traitement de la réponse du serveur, si nécessaire
                console.log('Réponse du serveur :', response);
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', error);
            }
        })
    }
</script>
</body>
