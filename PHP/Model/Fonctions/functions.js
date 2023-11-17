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
function addQuestion() {
    i = parseInt(i) + 1;
    console.log(i);
    var doc = document.getElementById('newQ');
    const questionContainer = document.createElement('div');
    questionContainer.classList.add('question-container');
    const input = document.createElement('input');
    input.type = "text";
    input.placeholder = "Question...";
    input.name = "question" + i.toString();
    input.classList.add('input_question');
    const responseCountContainer = document.createElement('div');
    responseCountContainer.classList.add('response-count-container');
    const inputhidden = document.createElement('input');
    inputhidden.type = "hidden";
    inputhidden.name = "nbReponseQ" + i.toString();
    inputhidden.id = "nbReponseQ" + i.toString();
    inputhidden.value = "0";
    questionContainer.appendChild(input);
    questionContainer.appendChild(responseCountContainer);
    questionContainer.appendChild(inputhidden);
    input.style.margin = '10px';
    doc.appendChild(questionContainer);
    document.getElementById('nbQuestion').value = i;
}


function suppQuestion(i){
    //on supprime la question i
    var doc = document.getElementById('newQ');
    var input = document.getElementsByName("question"+i.toString())[0];
    var inputhidden = document.getElementById("nbReponseQ"+i.toString());
    doc.removeChild(input);
    // on supprime les reponses de la question i
    var nbReponse = inputhidden.value;
    for(var j=1;j<=nbReponse;j++){
        var input = document.getElementsByName("Q"+i.toString()+"reponse"+j.toString())[0];
        doc.removeChild(input);
    }
    doc.removeChild(inputhidden);
    if(i>0){
        i = parseInt(i) - 1;
    }
    document.getElementById('nbQuestion').value=i;
    return i;
}

var j=0;
function addReponse(i) {
    j++;
    var doc = document.getElementById('newQ');
    var responseCountContainer = document.getElementsByClassName('response-count-container')[i - 1];
    const input = document.createElement('input');
    input.type = "text";
    input.placeholder = "Réponse...";
    input.name = "Q" + i.toString() + "reponse" + j.toString();
    input.classList.add('input_reponse');
    input.style.margin = '3px';
    input.style.marginBottom = '10px';
    doc.appendChild(input);
    var nbReponseInput = responseCountContainer.lastElementChild;
    nbReponseInput.value = j;
}
