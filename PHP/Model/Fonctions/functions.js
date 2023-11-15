
function changer(id){
    if(document.getElementById(id).getAttribute("type")=="password" ){
        document.getElementById(id).setAttribute("type","text");
    }
    else{
        document.getElementById(id).setAttribute("type","password");
    }
}

/* Fonction qui permet de rechercher un nom dans une liste sur la page Validation*/

function search_Nom() {
    let input = document.getElementById('searchbar').value
    input=input.toLowerCase();
    let x = document.getElementsByClassName('test');

    for (i = 0; i < x.length; i++) {
        if (!x[i].innerHTML.toLowerCase().includes(input)) {
            x[i].style.display="none";
        }
        else {
            x[i].style.display="table-row";
        }
    }
}

//Fonction qui sert a envoyé un popUp
function popupUser(){
    Swal.fire({
        icon: 'check',
        title: 'Validé',
        text: "Vous avez bien mis à jour l'utilisateur."})
}

//Fonction afin d'ajouter une question dans une div
var i = 0;
function addQuestion(){
    var doc = document.getElementById('newQ');
    const input = document.createElement('input');
    input.type="text";
    input.placeholder="Question...";
    input.name="question" +i.toString();
    input.classList.add('input_question');
    doc.appendChild(input);
    i = i + 1;
    return i;
}
