function trimText(id) {
    let element = document.getElementById(id);
    element.innerHTML = element.textContent.trim();
}

//-----------Sezione commenti--------------------
function commentoVuoto() {
    let commentText = document.getElementById("textarea").value.trim();
    if (commentText.length === 0) {
        alert("Il commento non può essere vuoto");
        return false;
    }
    return true;
}

function updateNum() {
    let textarea = document.getElementById("textarea").value;
    document.getElementById("MaxChar").innerHTML = (300 - textarea.length).toString();
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

function miPiace(idstring) {
    let classList = document.getElementById(idstring).classList;
    let id = idstring.replace("Label", "");
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

function eliminaCommento(idstring) {
    let id = idstring.replace("commento_", "");
    if (confirm('Sei sicuro di voler rimuovere il commento?')) {
        $.ajax({
            type: "GET",
            url: "delete.php?id=" + id,
            success: function () {
                let commento = document.getElementById(idstring);
                let nodes = commento.parentNode.childNodes;
                if (nodes.length === 1 ){
                    let listacommenti = commento.parentNode.parentNode;
                    listacommenti.removeChild(commento.parentNode);
                    let p = document.createElement("P");
                    p.appendChild(document.createTextNode("Non ci sono commenti al momento"));
                    listacommenti.appendChild(p);
                }
                else{
                    commento.parentNode.removeChild(commento);
                }
            },
            error: function () {
                alert("Non è stato possibile rimuovere il commento")
            }
        })
    }
}

//-----------Fine sezione commenti--------------------


// ------------------------- LOGIN --------------------------


function mostraErrore(input, testoErrore) {

    togliErrore(input);

    var p = input.parentNode;
    if (p.children.length == 2) {
        var strong = document.createElement("strong");
        //strong.className="corsivo";
        strong.appendChild(document.createTextElement(testoErrore)); //span.innerHTML=testoErrore;
        p.appendChild
        p.appendChild(strong);
    }
}

function togliErrore(input) {
    var p = input.parentNode;

    if (p.children.length > 2) {
        p.removeChild(p.children[2]); //rimuovo il terzo figlio di p
    }

    /*var span = p.lastChild;
    p.removeChild(span);*/
}


function checkNome(Nomeinput) {
    var patt = new RegExp('^[a-zA-Z]{3,}$');
    if (patt.tets(Nomeinput.value)) {  //mi mostra il valore contenuto in input
        togliErrore(Nomeinput);
        return true;
    } else {
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

    return risultatoNome && risultatoColore && risultatoPeso && risultatoDescrizione;

}

/*
<form action="insert.php" onsubmit="return validazioneForm()">
    <p>
        <label>
        <input id="nome">
        <span>Errore nellínserimento del nome</span>

*/

// --------------------- FINE LOGIN ---------------------------

// ------------------- REGIS
/*----------------------HEADER MOBILE----------------------------*/

function openMenu() {
    var openButton = document.getElementById("openButton");
    var menu = document.getElementById("menu");
    var closeButton = document.getElementById("closeButton")

    openButton.classList.add('openButton-js-hidden');
    menu.classList.add('js-opened');
    closeButton.classList.add('js-opened');

}
function closeMenu() {
    var openButton = document.getElementById("openButton");
    var menu = document.getElementById("menu");
    var closeButton = document.getElementById("closeButton")

    openButton.classList.remove('openButton-js-hidden');
    menu.classList.remove('js-opened');
    closeButton.classList.remove('js-opened');

}
function openSearch() {
var openSearch = document.getElementById("mobileButton");
var mobileBar = document.getElementById("searchBar");
var exitButton = document.getElementById("closeSearch");

openSearch.setAttribute('id','mobileButtonHidden');
mobileBar.setAttribute('id','searchBarMobile');
exitButton.setAttribute('id','closeSearchBar');
}

function closeSearch (){
    var mobileButton = document.getElementById("mobileButtonHidden");
    var mobileBarHiden = document.getElementById("searchBarMobile");
    var closeSearchHidden = document.getElementById("closeSearchBar");

    mobileButton.setAttribute('id','mobileButton');
    mobileBarHiden.setAttribute('id','searchBar');
    closeSearchHidden.setAttribute('id','closeSearch');
}