<?php
include ("../../View/BarreMenu/BarreMenu.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleCholage.css">
    <link rel="stylesheet" href="../../View/Style/styleGestionEquipeOrga.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<div class="GestionEquipeOrga-container-fluid GestionEquipeOrga-mx">
    <div class="row">
        <div class="col-xl-3"></div>
        <div class="col-xl-6" id="divEquipe">
            <br>
            <?php
            foreach($_SESSION["lstEquipes"] as $lstEquipe){
                echo '<div class="card" style="width: 75%;" id="'.$lstEquipe[0].'" ondragover="activerdrop()" ondrop="drop() ">
                <div class="card-body" id="body/'.$lstEquipe[0].'" > 
                    <h5 class="card-title" id="tittle/'.$lstEquipe[0].'" >'.$lstEquipe[0].'</h5>
                    <p class="card-text" id="text/'.$lstEquipe[0].'">
                    <div class="list-group" id="'."listgroup/".$lstEquipe[0].'">';
                foreach ($_SESSION["membreEquipe".$lstEquipe[0]] as $membreEquipe){
                    if ($membreEquipe[3]) {
                        echo '<li class="list-group-item list-group-item-primary" draggable="true" id="' . $membreEquipe[4] . "/" . $lstEquipe[0] . '" ondragstart="recupererData()">' . $membreEquipe["nom"] . " " . $membreEquipe["prenom"] . '      <a>capitaine</a>  <input type="checkbox" id="iscaptain/'.$membreEquipe[4].'" onclick="setchecked()" value="true" checked="checked"></li>';
                    }
                    else{
                        echo '<li class="list-group-item list-group-item-primary" draggable="true" id="' . $membreEquipe[4] . "/" . $lstEquipe[0] . '" ondragstart="recupererData()">' . $membreEquipe["nom"] . " " . $membreEquipe["prenom"] . '  <input type="checkbox" id="iscaptain/'.$membreEquipe[4].'" onclick="setchecked()" value="true" ></li>';
                    }
                };
                echo '</div>
                    <input type="hidden" id="equipe'.$lstEquipe[0].'" value="'.$lstEquipe[2].'">
                    <input type="button" id="equipe/'.$lstEquipe[0].'" value="Supprimer" onclick="supprEquipe(document.getElementById(\'equipe'.$lstEquipe[0].'\').value)">
                    </p>
                </div>
            </div>
            <br><br>';
            }
            ?>
            <input type="button" id="creerEquipe" value="rajouter une équipe" onclick="creerEquipe()">
        </div>

        <div class="col-xl-3 DivJoeurSansEquipe" id="col/vide" ondragover="activerdrop()" ondrop="drop()">
            <div class="list-group" id="listgroup/vide" ondragover="activerdrop()" ondrop="drop() ">
                <?php
                foreach ($_SESSION["membreSansEquipe"] as $membreSansEquipe){
                   echo '<li class="list-group-item list-group-item-primary" id="'.$membreSansEquipe[2].'/vide" value="'.$membreSansEquipe[2].'" draggable="true" ondragstart="recupererData()">'.$membreSansEquipe[0]." ".$membreSansEquipe[1].'</li>';
                }

                ?>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>
    function supprimerEquipe(idequipe) {
        $.ajax({
            url:("../../Model/Tournoi/SupprEquipePost.php"),
            type: 'POST',
            data: { action: 'supprEquipe',idequipe: idequipe },
            success: function(response) {
                console.log('Réponse du serveur :', response);
                location.reload()
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', error);
            }
        });
    }


    function supprEquipe(idequipe){
        Swal.fire({
            title: "Supression équipe",
            text:"Vous allez supprimer l'équipe",
            icon:"warning",
            showConfirmButton: true,
            showCancelButton: true,
            cancelButtonText: "Annuler",
            confirmButtonText: "Valider"
        }).then((result)=>{
            if (result.value){
                supprimerEquipe(idequipe)
            }

        })
    }


    function recupererData(){
        event.dataTransfer.setData("text",event.target.id);
    }


    function activerdrop(){
        event.preventDefault();
    }


    function drop(){
        event.preventDefault();
        var idjoueur=event.dataTransfer.getData("text");

        var idelementdeplace=idjoueur.split("/");

        var iddiv=event.target.id.split("/");

        console.log("iddiv: " + iddiv);

        var elementdeplace=document.getElementById(idjoueur);

        if(!event.target.id.includes("vide") && idelementdeplace[1].includes("vide")){
            var checkbox=document.createElement("input");
            checkbox.type="checkbox";
            checkbox.id="iscaptain/"+idelementdeplace[0];
            elementdeplace.appendChild(checkbox);
        }
        else if (event.target.id.includes("vide")){
            elementdeplace.removeChild(document.getElementById("iscaptain/"+idelementdeplace[0]));
        }

        if (event.target.id.includes("listgroup/")){
            var madiv=document.getElementById(event.target.id);
        }
        else{
            console.log("listgroup/"+iddiv[1])
            var madiv=document.getElementById("listgroup/"+iddiv[1]);
        }
        madiv.prepend(elementdeplace);

        elementdeplace.id=idelementdeplace[0]+"/"+iddiv[1];
    }


    function setchecked(){
        console.log(event.target.checked);
    }



    function creerEquipe(){

        Swal.fire({
            input: "text",
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: "valider",
            cancelButtonText: "annuler"
        }).then((result)=> {
            if (result.value) {
                console.log(`${result.value}`);

                var divCard = document.createElement("div");
                divCard.className = "card";
                divCard.style.width = "75%";
                divCard.ondrop = drop;
                divCard.ondragover = activerdrop;
                divCard.id=`${result.value}`

                var divCardBody = document.createElement("div");
                divCardBody.className = "card-body";
                divCardBody.id="body/"+`${result.value}`;
                divCard.appendChild(divCardBody);

                var divCardTittle = document.createElement("h5");
                divCardTittle.className = "card-tittle";
                divCardTittle.textContent = `${result.value}`
                divCardTittle.id="tittle/"+`${result.value}`;
                divCardBody.appendChild(divCardTittle);

                var divCardText = document.createElement("p");
                divCardText.className = "card-text"
                divCardText.id="text/"+`${result.value}`
                divCardBody.appendChild(divCardText);

                var listGroupCardText = document.createElement("div");
                listGroupCardText.className = "list-group";
                listGroupCardText.id="listgroup/"+`${result.value}`
                divCardText.appendChild(listGroupCardText);

                var inputCardText = document.createElement("input");
                inputCardText.type = "button";
                inputCardText.value = "Supprimer Equipe";
                inputCardText.id="text/"+`${result.value}`
                divCardText.appendChild(inputCardText);

                var colonneEquipe = document.getElementById("divEquipe");
                colonneEquipe.appendChild(divCard);

                var bouton = document.getElementById("creerEquipe")
                var nouvBouton = bouton.cloneNode(true)
                colonneEquipe.removeChild(bouton)
                colonneEquipe.appendChild(document.createElement("br"))
                colonneEquipe.appendChild(document.createElement("br"))
                colonneEquipe.appendChild(nouvBouton)
            }
        })


    }
</script>
</body>
</html>
