function trimText(id) {
    let element = document.getElementById(id);
    element.innerHTML = element.textContent.trim();
}

function commentoVuoto() {
    let commentText = document.getElementById("textarea").value;
    if (commentText.length === 0) {
        alert("Il commento non può essere vuoto");
        return false;
    }
    return true;
}

function updateNum() {
    let textarea = document.getElementById("textarea").value;
    document.getElementById("MaxChar").innerHTML = (300-textarea.length).toString();
}

function miPiaceOver(id) {
    let classList = document.getElementById(id).classList;
    if (classList.contains("upBlue"))
        return;
    if (classList.contains("upGray")) {
        classList.remove("upGray");
        classList.add("upBlack");
    }
}

function miPiaceOut(id) {
    let classList = document.getElementById(id).classList;
    if (classList.contains("upBlue"))
        return;
    if (classList.contains("upBlack")) {
        classList.remove("upBlack");
        classList.add("upGray")
    }
}

function miPiace(id) {
    let classList = document.getElementById(id).classList;
    if (classList.contains("upBlue")) {
        classList.remove("upBlue");
        classList.add("upBlack");

        $.ajax({
            type: "GET",
            url: "like.php?add=false&id=" + id
        })

    } else {
        classList.remove("upBlack");
        classList.add("upBlue");

        $.ajax({
            type: "GET",
            url: "like.php?add=true&id=" + id
        })
    }
}

// ------------------------- LOGIN --------------------------


function mostraErrore(input,testoErrore) {

    togliErrore(input);

    var p = input.parentNode;
    if(p.children.length == 2) {
        var strong = document.createElement("strong");
        //strong.className="corsivo";
        strong.appendChild(document.createTextElement(testoErrore)); //span.innerHTML=testoErrore;
        p.appendChild
        p.appendChild(strong);
    }
}

function togliErrore(input) {
    var p = input.parentNode;

    if(p.children.length > 2) {
        p.removeChild(p.children[2]); //rimuovo il terzo figlio di p
    }

    /*var span = p.lastChild;
    p.removeChild(span);*/
}


function checkNickname(Nomeinput) {
    var patt = new RegExp('^[a-zA-Z1-9]{3,15}$');
    if(patt.test(Nomeinput.value)) {  //mi mostra il valore contenuto in input
        togliErrore(Nomeinput);
        return true;
    }
    else {
        mostraErrore(Nomeinput,
            "Nome inserito non corretto (almeno 3 lettere) ");
        return false;
    }
}

function checkPassword(NomeInput) {
    var pass = new RegExp('^(?=.*[0-9])(?=.*[a-z])[a-zA-Z0-9!.@#$%^&*]{6,16}$');
    if(pass.test(NomeInput.value)) {
        togliErrore(NomeInput);
        return true;
    }

    return false;
}


function loadAccount() {
    var nickname = document.getElementById("emailLogin").value;
    var password = document.getElementById("passwordLogin").value;

    $.ajax()

    var risultatoNickname = checkNickname();
    var risultatopassword = checkPassword();

    return risultatoNickname && risultatopassword;

}

/*
<form action="insert.php" onsubmit="return validazioneForm()">
    <p>
        <label>
        <input id="nome">
        <span>Errore nellínserimento del nome</span>

*/

// --------------------- FINE LOGIN ---------------------------




// ------------------- REGISISTRAZIONE --------------------------

function mostraErrore(input,testoErrore) {

    togliErrore(input);

    var p = input.parentNode;
    if(p.children.length == 2) {
        var strong = document.createElement("strong");
        //strong.className="corsivo";
        strong.appendChild(document.createTextElement(testoErrore)); //span.innerHTML=testoErrore;
        p.appendChild
        p.appendChild(strong);
    }
}

function togliErrore(input) {
    var p = input.parentNode;

    if(p.children.length > 2) {
        p.removeChild(p.children[2]); //rimuovo il terzo figlio di p
    }

    /*var span = p.lastChild;
    p.removeChild(span);*/
}


function checkNome(Nomeinput) {
    var patt = new RegExp('^[a-zA-Z]{3,}$');
    if(patt.tets(Nomeinput.value)) {  //mi mostra il valore contenuto in input
        togliErrore(Nomeinput);
        return true;
    }
    else {
        mostraErrore(Nomeinput,
            "Nome inserito non corretto (almeno 3 lettere) ");
        return false;
    }
}

function checkColore() {
    return false;
}

function checkPeso() {
    var patt = new RegExp('^[1-9][0-9]{0,2}')
    return false;
}

function checkDescrizione() {
    return false;
}


function validazioneForm() {
    var nome = document.getElementById("nome");
    var colore = document.getElementById("colore");
    var peso = document.getElementById("peso");
    var descrizione = document.getElementById("descrizione");

    var risultatoNome = checkNome();
    var risultatoColore = checkColore();
    var risultatoPeso = checkPeso();
    var risultatoDescrizione = checkDescrizione();

    return risultatoNome && risultatoColore &&  risultatoPeso && risultatoDescrizione;


}

// ------------------- FINE REGISISTRAZIONE --------------------------