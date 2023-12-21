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
                echo '<div class="card" style="width: 75%;" id="'.$lstEquipe[2].'" ondragover="activerdrop()" ondrop="drop() ">
                <div class="card-body" id="body/'.$lstEquipe[2].'" > 
                    <h5 class="card-title" id="tittle/'.$lstEquipe[2].'" >'.$lstEquipe[0].'</h5>
                    <p class="card-text" id="text/'.$lstEquipe[2].'">
                    <div class="list-group" id="'."listgroup/".$lstEquipe[2].'">';
                foreach ($_SESSION["membreEquipe".$lstEquipe[0]] as $membreEquipe){
                    if ($membreEquipe[3]) {
                        echo '<li class="list-group-item list-group-item-primary" draggable="true" id="' . $membreEquipe[4] . "/" . $lstEquipe[2] . '" ondragstart="recupererData()">' . $membreEquipe["nom"] . " " . $membreEquipe["prenom"] . '      <b id="text/'.$membreEquipe[4]."/".$lstEquipe[2].'">capitaine</b>  <input type="checkbox" id="iscaptain/'.$membreEquipe[4]."/".$lstEquipe[2].'" onclick="ValiderCapitaine(\''.$membreEquipe[4].'\',\''.$lstEquipe[2].'\')" value="true" checked="checked"></li>';
                    }
                    else{
                        echo '<li class="list-group-item list-group-item-primary" draggable="true" id="' . $membreEquipe[4] . "/" . $lstEquipe[2] . '" ondragstart="recupererData()">' . $membreEquipe["nom"] . " " . $membreEquipe["prenom"] . '      <b id="text/'.$membreEquipe[4]."/".$lstEquipe[2].'">capitaine</b>    <input type="checkbox" id="iscaptain/'.$membreEquipe[4]."/".$lstEquipe[2].'" onclick="ValiderCapitaine(\''.$membreEquipe[4].'\',\''.$lstEquipe[2].'\')" value="true"></li>';
                    }
                };
                echo '</div>
                    <input type="hidden" id="equipe'.$lstEquipe[2].'" value="'.$lstEquipe[2].'">
                    <input type="button" id="equipe/'.$lstEquipe[2].'" value="Supprimer" onclick="supprEquipe(document.getElementById(\'equipe'.$lstEquipe[2].'\').value)">
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

        var elementdeplace=document.getElementById(idjoueur);

        if(!event.target.id.includes("vide") && idelementdeplace[1].includes("vide")){
            if (event.target.id.includes("text")){
                var text = document.createElement("b")
                text.textContent = "      capitaine     "
                text.id = "text/" + idelementdeplace[0] + "/" + iddiv[2];
                elementdeplace.appendChild(text)

                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.id = "iscaptain/" + idelementdeplace[0] + "/" + iddiv[2];
                checkbox.onclick = ValiderCapitaine
                elementdeplace.appendChild(checkbox);
            }
            else {
                var text = document.createElement("b")
                text.textContent = "      capitaine     "
                text.id = "text/" + idelementdeplace[0] + "/" + iddiv[1];
                elementdeplace.appendChild(text)

                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.id = "iscaptain/" + idelementdeplace[0] + "/" + iddiv[1];
                checkbox.onclick = ValiderCapitaine
                elementdeplace.appendChild(checkbox);
            }
        }
        else if (event.target.id.includes("vide")){
            console.log(idelementdeplace)
            elementdeplace.removeChild(document.getElementById("text/"+idelementdeplace[0]+"/"+idelementdeplace[1]))
            elementdeplace.removeChild(document.getElementById("iscaptain/"+idelementdeplace[0]+"/"+idelementdeplace[1]));
        }

        if (event.target.id.includes("listgroup/")){
            var madiv=document.getElementById(event.target.id);
        }
        else if (event.target.id.includes("text/")){
            var madiv=document.getElementById("listgroup/"+iddiv[2])
        }
        else{
            console.log("listgroup/"+iddiv[1])
            var madiv=document.getElementById("listgroup/"+iddiv[1]);
        }
        madiv.prepend(elementdeplace);

        if (!event.target.id.includes("vide") && !idelementdeplace[1].includes("vide")) {
            document.getElementById("iscaptain/" + idelementdeplace[0]+"/"+idelementdeplace[1]).id="iscaptain/"+idelementdeplace[0]+"/"+iddiv[1];
            document.getElementById("text/" + idelementdeplace[0]+"/"+idelementdeplace[1]).id="text/"+idelementdeplace[0]+"/"+iddiv[1];
        }
        elementdeplace.id=idelementdeplace[0]+"/"+iddiv[1];
        if (event.target.id.includes("vide")){
            AjaxRetirerJoueurEquipe(idelementdeplace[0])
        }
        else {
            AjaxAjoutJoueurEquipe(idelementdeplace[0], iddiv[1])
        }
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
                AjaxAjoutEquipe(`${result.value}`,function (idequipe){
                    var divCard = document.createElement("div");
                    divCard.className = "card";
                    divCard.style.width = "75%";
                    divCard.ondrop = drop;
                    divCard.ondragover = activerdrop;
                    divCard.id=`${result.value}`

                    var divCardBody = document.createElement("div");
                    divCardBody.className = "card-body";
                    divCardBody.id="body/"+idequipe;
                    divCard.appendChild(divCardBody);

                    var divCardTittle = document.createElement("h5");
                    divCardTittle.className = "card-tittle";
                    divCardTittle.textContent = `${result.value}`
                    divCardTittle.id="tittle/"+idequipe;
                    divCardBody.appendChild(divCardTittle);

                    var divCardText = document.createElement("p");
                    divCardText.className = "card-text"
                    divCardText.id="text/"+idequipe
                    divCardBody.appendChild(divCardText);

                    var listGroupCardText = document.createElement("div");
                    listGroupCardText.className = "list-group";
                    listGroupCardText.id="listgroup/"+idequipe
                    divCardText.appendChild(listGroupCardText);

                    var inputCardText = document.createElement("input");
                    inputCardText.type = "button";
                    inputCardText.value = "Supprimer";
                    inputCardText.id="text/"+idequipe
                    inputCardText.onclick=function () {
                        supprEquipe(idequipe)
                    }
                    divCardText.appendChild(inputCardText);

                    var colonneEquipe = document.getElementById("divEquipe");
                    colonneEquipe.appendChild(divCard);

                    var bouton = document.getElementById("creerEquipe")
                    var nouvBouton = bouton.cloneNode(true)
                    colonneEquipe.removeChild(bouton)
                    colonneEquipe.appendChild(document.createElement("br"))
                    colonneEquipe.appendChild(document.createElement("br"))
                    colonneEquipe.appendChild(nouvBouton)

                })
            }
        });
    }

    function AjaxAjoutEquipe(nomEquipe,callback){
        $.ajax({
            url: "../../Model/Tournoi/AjoutEquipeAjax.php",
            type : "POST",
            data: {nomEquipe:nomEquipe},
            success: function (response){
                callback(response)
            },
            error: function (xhr,status,error){
                console.error(error)
            }

        });
    }

        function AjaxAjoutJoueurEquipe(idjoueur,idequipe){
            $.ajax({
                url: "../../Model/Tournoi/AjoutJoueurAjax.php",
                type : "POST",
                data: {idjoueur:idjoueur,idequipe:idequipe},
                success: function (response){
                    console.log(response)
                },
                error: function (xhr,status,error){
                    console.error(error)
                }
            });
        }
        function AjaxRetirerJoueurEquipe(idjoueur){
            $.ajax({
                url: "../../Model/Tournoi/RetirerJoueurAjax.php",
                type : "POST",
                data: {idjoueur:idjoueur,idequipe:idequipe},
                success: function (response){
                    console.log(response)
                },
                error: function (xhr,status,error){
                    console.error(error)
                }
            });
        }
        function AjaxValiderCapitaine(idjoueur){
            $.ajax({
                url: "../../Model/Tournoi/AjoutCapitaineAjax.php",
                type : "POST",
                data: {idjoueur:idjoueur},
                success: function (response){
                    console.log(response)
                },
                error: function (xhr,status,error){
                    console.error(error)
                }
            });
        }
        function AjaxRetirerCapitaine(idjoueur){
            $.ajax({
                url: "../../Model/Tournoi/RetirerCapitaineAjax.php",
                type : "POST",
                data: {idjoueur:idjoueur},
                success: function (response){
                    console.log(response)
                },
                error: function (xhr,status,error){
                    console.error(error)
                }
            });
        }
        function Ajoutjoueur(idjoueur,idequipe){
            AjaxAjoutJoueurEquipe(idjoueur,idequipe);
        }
        function ValiderCapitaine(){
            checkboxactive=event.target
            var mesval=checkboxactive.id.split("/")
            console.log(mesval)
            if(checkboxactive.checked) {
                var mesCheckBoxs = document.querySelectorAll(".card input[type=checkbox ]");
                mesCheckBoxs.forEach(function verifCheckbox(checkbox) {
                    if (checkbox.id.includes(mesval[2])) {
                        if (checkbox !== checkboxactive && checkbox.checked) {
                            AjaxRetirerCapitaine(checkbox.id.split("/")[1])
                            checkbox.checked = false;
                        }
                    }
                });
                AjaxValiderCapitaine(mesval[1])
            }
            else{
                AjaxRetirerCapitaine(checkboxactive.id.split("/")[1])
            }
        }
</script>
</body>
</html>
