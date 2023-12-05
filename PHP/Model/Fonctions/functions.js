
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
function search_Nom_Plu_Barre(nb) {
    let input = document.getElementById('searchbar'+nb).value
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


//Fonction afin d'ajouter une question dans une div
var i = 0;
function addQuestion(i,j){
    j=0;
    i = parseInt(i) + 1;
    console.log(i);
    var doc = document.getElementById('newQ');
    const input = document.createElement('input');
    const passerLigne = document.createElement('br');
    const passerLigne2 = document.createElement('br');
    const inputRep1 = document.createElement('input');
    const inputRep2 = document.createElement('input');
    input.type="text";
    input.placeholder="Question...";
    input.name="question" +i.toString();
    input.style
    input.classList.add('input_question');
    inputRep1.type="text";
    inputRep1.value="Oui";
    inputRep1.name="Q"+i.toString()+"reponse"+j.toString();
    inputRep1.classList.add('input_reponse');
    inputRep1.style.margin = '5px';
    j++;
    inputRep2.type="text";
    inputRep2.value="Non";
    inputRep2.name="Q"+i.toString()+"reponse"+j.toString();
    inputRep2.classList.add('input_reponse');
    inputRep2.style.margin = '5px';
    const inputhidden = document.createElement('input');
    inputhidden.type="hidden";
    inputhidden.name="nbReponseQ"+i.toString();
    inputhidden.id="nbReponseQ"+i.toString();
    inputhidden.value="0";
    passerLigne.id = "passerLigne"+i.toString();
    passerLigne2.id = "passerLigne2"+i.toString();
    doc.appendChild(passerLigne);
    doc.appendChild(input);
    doc.appendChild(inputhidden);
    doc.appendChild(inputRep1);
    doc.appendChild(inputRep2);
    doc.appendChild(passerLigne2);
    document.getElementById('nbQuestion').value=i;
    document.getElementById('nbReponseQ'+i.toString()).value=j;
    return i,j;
}


function suppQuestion(i){
    //on supprime la question i
    var doc = document.getElementById('newQ');
    var input = document.getElementsByName("question"+i.toString())[0];
    var inputhidden = document.getElementById("nbReponseQ"+i.toString());
    var passerLigne =document.getElementById("passerLigne"+i.toString());
    var passerLigne2 =document.getElementById("passerLigne2"+i.toString());
    doc.removeChild(input);
    // on supprime les reponses de la question i
    var nbReponse = inputhidden.value;
    for(var j=0;j<=nbReponse;j++){
        var input = document.getElementsByName("Q"+i.toString()+"reponse"+j.toString())[0];
        doc.removeChild(input);
    }
    doc.removeChild(inputhidden);
    doc.removeChild(passerLigne);
    doc.removeChild(passerLigne2);
    if(i>0){
        i = parseInt(i) - 1;
    }
    document.getElementById('nbQuestion').value=i;
    return i;
}
/*
var j=0;
function addReponse(i,j){
    console.log(j);
    j++;
    var doc = document.getElementById('newQ');
    const input = document.createElement('input');
    input.type="text";
    input.placeholder="Réponse...";
    input.name= "Q"+i.toString()+"reponse"+j.toString();
    input.classList.add('input_reponse');
    input.style.margin = '5px';
    input.style.marginBottom = '5px';
    doc.appendChild(input);
    document.getElementById('nbReponseQ'+i.toString()).value=j;
}
*/